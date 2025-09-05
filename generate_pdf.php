<?php 
require('admin/inc/essentials.php');
require('admin/inc/db_config.php');
require('admin/inc/mpdf/vendor/autoload.php');

session_start();

if(!(isset($_SESSION['login']) && $_SESSION['login']==true)){
    redirect('index.php');
}

if(isset($_GET['gen_pdf']) && isset($_GET['id']))
{
    $frm_data = filteration($_GET);

    $query = "SELECT bo.*, bd.*,uc.email FROM `booking_order` bo
        INNER JOIN `booking_details` bd ON bo.booking_id = bd.booking_id
        INNER JOIN `user_cred` uc ON bo.user_id = uc.id
        WHERE ((bo.booking_status='booked' AND bo.arrival=1) 
        OR (bo.booking_status='cancelled' AND bo.refund=1)
        OR (bo.booking_status='payment failed')) 
        AND bo.booking_id = '$frm_data[id]'";

    $res = mysqli_query($con,$query);
    $total_rows = mysqli_num_rows($res);

    if($total_rows==0){
        header('location: index.php');
        exit;
    }

    $data = mysqli_fetch_assoc($res);

    $date = date("h:ia | d-m-Y",strtotime($data['datentime']));
    $checkin = date("d-m-Y",strtotime($data['check_in']));
    $checkout = date("d-m-Y",strtotime($data['check_out']));

    // HTML content with mixed languages
    $content = "
<style>
  body { font-family: 'dejavusans'; font-size: 12pt; }
  .header { text-align: center; margin-bottom: 20px; }
  .header h2 { margin: 0; color: #333; }
  .logo { height: 200px;
  width: 200px; }
  .details-table {
    width: 100%; border-collapse: collapse; margin-top: 20px;
  }
  .details-table td {
    padding: 10px; border: 1px solid #ccc; vertical-align: top;
  }
  .status-booked { color: green; font-weight: bold; }
  .status-cancelled { color: red; font-weight: bold; }
  .status-failed { color: #c77d00; font-weight: bold; }
  
</style>

<div class='header'>
  <img src='images/instaroom.jpg' class='logo' />
  <h2>Booking Receipt</h2>
  <p>Order ID: <strong>$data[order_id]</strong></p>
</div>

<table class='details-table'>
  <tr>
    <td>Booking Date</td>
    <td>$date</td>
  </tr>
  <tr>
    <td>Status</td>
    <td class='status-".strtolower($data['booking_status'])."'>".ucfirst($data['booking_status'])."</td>
  </tr>
  <tr>
    <td>Name</td>
    <td >$data[user_name]</td>
  </tr>
  <tr>
    <td>Email</td>
    <td>$data[email]</td>
  </tr>
  <tr>
    <td>Phone Number</td>
    <td>$data[phonenum]</td>
  </tr>
  <tr>
    <td>Address</td>
    <td >$data[address]</td>
  </tr>
  <tr>
    <td>Room Name</td>
    <td >$data[room_name]</td>
  </tr>
  <tr>
    <td>Cost</td>
    <td>YER$data[price] per night</td>
  </tr>
  <tr>
    <td>Check-in</td>
    <td>$checkin</td>
  </tr>
  <tr>
    <td>Check-out</td>
    <td>$checkout</td>
  </tr>
";

if ($data['booking_status'] == 'cancelled') {
    $refund = ($data['refund']) ? "Amount Refunded" : "Not Yet Refunded";
    $content .= "
    <tr>
      <td>Amount Paid</td>
      <td>YER$data[trans_amt]</td>
    </tr>
    <tr>
      <td>Refund Status</td>
      <td>$refund</td>
    </tr>";
}
else if ($data['booking_status'] == 'payment failed') {
    $content .= "
    <tr>
      <td>Transaction Amount</td>
      <td>YER$data[trans_amt]</td>
    </tr>
    <tr>
      <td>Failure Response</td>
      <td >$data[trans_resp_msg]</td>
    </tr>";
}
else {
    $content .= "
    <tr>
      <td>Room Number</td>
      <td>$data[room_no]</td>
    </tr>
    <tr>
      <td>Amount Paid</td>
      <td>YER$data[trans_amt]</td>
    </tr>";
}

$content .= "</table>";


    // Create mPDF instance with Arabic support
    $mpdf = new \Mpdf\Mpdf([
        'mode' => 'utf-8',
        'format' => 'A4',
        'default_font' => 'dejavusans', // Font that supports both English and Arabic
        'autoArabic' => true,
        'autoScriptToLang' => true
    ]);
    // Support for RTL text when needed
    $mpdf->autoScriptToLang = true;
    $mpdf->autoArabic = true;
    // Set watermark image (stamp or logo)
    $mpdf->SetWatermarkImage('images/instaroom.jpg', 0.2, '', [300, 300]); // [width, height]
    $mpdf->showWatermarkImage = true;

    // Write content
    $mpdf->WriteHTML($content);
    
    // Output the file
    $mpdf->Output($data['order_id'].'.pdf', 'I');
}
else{
    header('location: index.php');
}
?>