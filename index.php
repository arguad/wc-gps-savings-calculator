<?php
/**
 * Plugin Name: GPS Tracking ROI Calculator
 * Plugin URI:
 * Description: Displays a calculator that you can use to work out savings from gps tracking your fleet of vehicles.
 * Version: 1.0
 * Author: GPYes Tracking Solutions
 * Author URI: https://www.gpyes.com.au
 * Text Domain: roicalculator
 * Domain Path: /languages
 * License: GPL v2 or later
 * License URI: http://www.gnu.org/licenses/gpl-2.0.html
 */

function gpyes_add_stylesheet() {
wp_register_style('gpyes_stylesheet', plugins_url( 'style.css', __FILE__ ));
wp_register_script( 'gpyes-js', plugins_url( 'script.js', __FILE__ ), array( 'jquery' ));
}

add_action( 'wp_print_styles', 'gpyes_add_stylesheet' );
function gpyes_set_content_type(){
    return "text/html";
}
add_filter( 'wp_mail_content_type','gpyes_set_content_type' );



function gpyes_calculator_show($atts) {
wp_enqueue_style('gpyes_stylesheet');

wp_enqueue_script( 'gpyes-js', plugins_url( 'script.js', __FILE__ ), array( 'jquery' ));




if(isset($_POST['emailreport']) && !empty($_POST['emailreport']))
{
	$val='<div class="calculator_container">';

	// Create email headers


	$headers = array('Content-Type: text/html; charset=UTF-8');


	//$subject="Your saving on installation GPS Device";
	$subject="GPS Tracking - Your Calculated Savings";

	//$contents="Here is your summary of saving on installation of GPS Device: <br/><br/>";
	$contents="By installing a GPS Tracking system you would see the following savings: <br/><br/> ";

	$contents.="<br/>Reduced Labour Cost :".esc_html($_POST['reducedlabourcost']);
	$contents.="<br/>Increased Revenue :".esc_html($_POST['increasedrevenue']);
	$contents.="<br/>Fuel Savings :".esc_html($_POST['fuelsavings']);
	$contents.="<br/>Service Reduction due to wear & tear :".esc_html($_POST['servicereduction']);
	$contents.="<br/>Reduction in accidents :".esc_html($_POST['accidentreduction']);
	$contents.="<br/><strong>Total Savings :".esc_html($_POST['totalsavings']).'</strong>';

	$contents.="<br/><br/>Thank you";

	$mailid = sanitize_email($_POST['emailreport']);
	if(wp_mail($mailid, $subject, $contents, $headers))
	{
			$val .='Please check your email account to see your copy of the GPS Tracking ROI calculator results';
			//$val .='You will get the report on your mail id.';
	}
	else
	{
			$val .='Please check your email account to see your copy of the GPS Tracking ROI calculator results';
			//$val .='You will get the report on your mail id';
	}
	$val .='</div>';
}
else{
 $val='';
$val = <<<EOD
<div class="calculator_container">


	      <div class="form-outer">
        <form action="#" id="frmsavingcalc" method="POST">
          <div class="page slide-page">
            <h2>Increase revenue by reducing costs of labour</h2>
<p>Your employees may arrive to the job site 15 minutes late, take an extended 1 hour lunch break, then leave 15 minutes early. <br/><br/> This adds up to 1 hour of lost time each day. However, their timesheet shows a full 8 hours of work.</p>
            <div class="field">
              <div class="label">Number of employees</div>
              <input type="number" id="employeecount" name="employeecount" value="10">
            </div>
            <div class="field">
              <div class="label">Hourly employee rate (in $)</div>
              <input type="number" id="hourlyrate" name="hourlyrate" value="40.00" step="0.5">
            </div>
			  <div class="field">
              <div class="label">Charge out rate (in $)</div>
              <input type="number" id="chargeoutrate" name="chargeoutrate" value="90.00" step="0.5">

            </div>
			  <div class="field">
              <div class="label">Lost minutes daily per employee</div>
              <input type="number" id="losttime" name="losttime" value="60" >

            </div>
            <div class="field">
              <button class="firstNext next">Next</button>
            </div>
          </div>

		            <div class="page page2">
            <h2>Lower fuel costs of your fleet</h2>
<p>Installation of a GPS tracking system reduces mileage and fuel consumption.<br/><br/> Your fleets costs such as fuel, oil & fluid changes, tyres and servicing will be lowered due to the reduction in non-work related vehicle use, unnecessary idling & harsh driving. </p>
            <div class="field">
              <div class="label">How many vehicles in your fleet?</div>
              <input type="number" id="vehiclecount" name="vehiclecount" value="10">
            </div>
            <div class="field">
              <div class="label">What is the average km's that your fleet travels per day?</div>
              <input type="number" id="averagekmdaily" name="averagekmdaily" value="450" >
            </div>
			  <div class="field">
              <div class="label">What is the average fuel cost per litre (in $)?</div>
              <input type="number" id="fuelcost" name="fuelcost" value="1.50" step="0.1">

            </div>
			  <div class="field">
              <div class="label">What are your vehicles average fuel enconomy?(L/100km)</div>
              <input type="number" id="fueleconomy" name="fueleconomy" value="13.00" >

            </div>
             <div class="field btns">
              <button class="prev-1 prev">Previous</button>
              <button class="next-1 next">Next</button>
            </div>
          </div>



          <div class="page page3">
		  <h2>Reduce the associated costs of operating your fleet</h2>
      <p>Save time planning and scheduling your vehicles maintenance, reduce insurance premiums and vehicle accidents by monitoring your employees driving.</p>
           <div class="field">
              <div class="label">Average service interval of your fleet in KM?</div>
              <input type="number" id="serviceinterval" name="serviceinterval" value="15000">
            </div>
            <div class="field">
              <div class="label">Average cost of service including parts and labour (in $)</div>
              <input type="number" id="servicecost" name="servicecost" value="450" >
            </div>

			  <div class="field">
              <div class="label">Average cost of repair for a vehicle (in $)</div>
              <input type="number" id="repaircost" name="repaircost" value="3500" >

            </div>
            <div class="field btns">
              <button class="prev-2 prev">Previous</button>
              <button class="next-2 next">Next</button>
            </div>
          </div>

          <div class="page page4">
            <h2>Calculated GPS Tracking Return on Investment</h2>
<p>Using the calculations below, a GPS tracking system will provide with instant return on investment, and will quickly pay for itself.</p>
<p>Contact us today for an obligation free consultation.</p>
			  <div class="field">
              <div class="label">Reduced Labour Cost dollar amount</div>
              <input type="number" id="reducedlabourcost" name="reducedlabourcost" value="7000.00" readonly>
            </div>
            <div class="field">
              <div class="label">Increased revenue dollar amount</div>
              <input type="number" id="increasedrevenue" name="increasedrevenue" value="15000.00" readonly>
            </div>
			  <div class="field">
              <div class="label">Fuel savings dollar amount</div>
              <input type="number" id="fuelsavings" name="fuelsavings" value="3360">

            </div>
			  <div class="field">
              <div class="label">5% reduction in service costs due to wear & tear dollar amount</div>
              <input type="number" id="servicereduction" name="servicereduction" value="120.00" readonly>

            </div>


            <div class="field">
              <div class="label">20% reduction in accidents dollar amount</div>
              <input type="number" id="accidentreduction" name="accidentreduction" value="58.33" readonly>
            </div>
			  <div class="field">
              <div class="label">Total $ savings per month</div>
              <input type="number" id="totalsavings" name="totalsavings" value="27725.83" readonly>

            </div>
			  <div class="field" style="margin-top:50px">
              <div class="label">Email this report to someone*</div>
              <input type="email" id="emailreport" name="emailreport" required >

            </div>

			  <div class="field err" style="display:none"></div>



            <div class="field btns">
              <button class="prev-3 prev">Previous</button>
              <button class="submit">Submit</button>
            </div>
          </div>
        </form>
      </div>
    </div>
EOD;
}
return $val;
}
// register shortcode
add_shortcode('gps_roi_calculator', 'gpyes_calculator_show');





?>
