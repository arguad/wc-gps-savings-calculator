const slidePage = document.querySelector(".slide-page");
const Page2 = document.querySelector(".page2");
const Page3 = document.querySelector(".page3");
const Page4 = document.querySelector(".page4");

const nextBtnFirst = document.querySelector(".firstNext");
const prevBtnSec = document.querySelector(".prev-1");
const nextBtnSec = document.querySelector(".next-1");
const prevBtnThird = document.querySelector(".prev-2");
const nextBtnThird = document.querySelector(".next-2");
const prevBtnFourth = document.querySelector(".prev-3");
const submitBtn = document.querySelector(".submit");
const progressText = document.querySelectorAll(".step p");
const progressCheck = document.querySelectorAll(".step .check");



const employeecount = document.querySelector("#employeecount");
const hourlyrate = document.querySelector("#hourlyrate");
const chargeoutrate = document.querySelector("#chargeoutrate");
const losttime = document.querySelector("#losttime");

const vehiclecount = document.querySelector("#vehiclecount");
const averagekmdaily = document.querySelector("#averagekmdaily");
const fuelcost = document.querySelector("#fuelcost");
const fueleconomy = document.querySelector("#fueleconomy");

const serviceinterval = document.querySelector("#serviceinterval");
const servicecost = document.querySelector("#servicecost");

const repaircost = document.querySelector("#repaircost");

const reducedlabourcost = document.querySelector("#reducedlabourcost");
const increasedrevenue = document.querySelector("#increasedrevenue");
const fuelsavings = document.querySelector("#fuelsavings");
const servicereduction = document.querySelector("#servicereduction");

const accidentreduction = document.querySelector("#accidentreduction");
const totalsavings = document.querySelector("#totalsavings");
const emailreport = document.querySelector("#emailreport");

const errdiv = document.querySelector(".err");





let current = 1;

nextBtnFirst.addEventListener("click", function(event){
  event.preventDefault();
  slidePage.style.marginLeft = "-25%";
  
 
  current += 1;
  calculateSavings();
});
nextBtnSec.addEventListener("click", function(event){
  event.preventDefault();
  slidePage.style.marginLeft = "-50%";
  Page2.style.marginLeft = "-25%";
  
 
  current += 1;
  calculateSavings();
});
nextBtnThird.addEventListener("click", function(event){
  event.preventDefault();
  slidePage.style.marginLeft = "-75%";
  Page2.style.marginLeft = "-50%";
  Page3.style.marginLeft = "-25%";
  
  
  current += 1;
  calculateSavings();
});
submitBtn.addEventListener("click", function(e){
	
   
  current += 1;
  if(emailreport.value.trim()=='')
  {
	  errdiv.style.display="block";
	  errdiv.innerHTML="Please enter valid email";
	  return false;
  }else{
      //document.querySelector(".form-outer").innerHTML +="The report has been emailed."
  }
  
 
});

prevBtnSec.addEventListener("click", function(event){
  event.preventDefault();
  slidePage.style.marginLeft = "0%";
  Page2.style.marginLeft = "0%";
  Page3.style.marginLeft = "0%";
   
  
  current -= 1;
  calculateSavings();
});
prevBtnThird.addEventListener("click", function(event){
  event.preventDefault();
  slidePage.style.marginLeft = "-25%";
  Page2.style.marginLeft = "0%";
  Page3.style.marginLeft = "0%";
   
  current -= 1;
  calculateSavings();
});
prevBtnFourth.addEventListener("click", function(event){
  event.preventDefault();
  slidePage.style.marginLeft = "-50%";
  Page2.style.marginLeft = "-25%";
  Page3.style.marginLeft = "0%";
   
  current -= 1;
  calculateSavings();
});

function calculateSavings()
{

/* 
Assumption: Below calculations are based on assumption that staff works 8 hours a day, 25 days in a month 

Following are the formulas used:

Reduced Labout cost = 10% of employee count x hourly rate x 8 hours x 25 days
Increased revenue = 10% of Charge out rate x 8 hours x 25 days x Employee count
Fuel Saving = 20% of (Average Daily KM / Fuel economy ) x Fuel cost x Vehicle Count  x 25 days
Service Reduction = 5% of Difference of Running KM (Before  and After GPS). With GPS km is calculated as 20% less than the that of without GPS.



Reduction in Accident = 1.67% of Current Repair Cost


*/

 reducedlabourcost.value  = Math.round(parseFloat(employeecount.value) * parseFloat(hourlyrate.value) * 8 * 25 * 0.10);
 increasedrevenue.value = Math.round(parseFloat(chargeoutrate.value) * 8 * 25 * parseFloat(employeecount.value) * 0.10 );
 fuelsavings.value =Math.round( (parseFloat(averagekmdaily.value) / parseFloat(fueleconomy.value)) * parseFloat(fuelcost.value) * parseFloat(vehiclecount.value) * 25 * 0.20);
 
 
 accidentreduction.value = Math.round(parseFloat(repaircost.value) * 0.016667);
 
 var totalkminamonth = Math.round(parseFloat(vehiclecount.value) * parseFloat(averagekmdaily.value) * 25);
 var averageservicecost = Math.round((totalkminamonth / parseFloat(serviceinterval.value))  * parseFloat(servicecost.value));
 
 var totalkminamonth_aftersaving = totalkminamonth - (totalkminamonth * 0.20);
 var averageservicecost_aftersaving = (totalkminamonth_aftersaving / parseFloat(serviceinterval.value)) * parseFloat(servicecost.value);
 
 servicereduction.value = Math.round((averageservicecost - averageservicecost_aftersaving) * 0.5);
 
 totalsavings.value = Math.round(parseFloat(reducedlabourcost.value) + parseFloat(increasedrevenue.value) + parseFloat(fuelsavings.value) + parseFloat(servicereduction.value)  + parseFloat(accidentreduction.value));
 /*
 emailreport = ;
*/
	
}