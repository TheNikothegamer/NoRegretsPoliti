var charges = [];
var totalTime = 0;
var totalFine = 0;
var speedFine = 0;
var getSaved = localStorage.getItem("getTextExtras");
var getFlipped = localStorage.getItem("checkFlipped");
var getDesc = localStorage.getItem("desc");
var hideMe = setTimeout(hidePopup,1500);
var charCount = 0;
clearTimeout(hideMe);

var charge = function(name, time, fine) {
  this.name = name;
  this.time = time;
  this.fine = fine;
  this.count = 1;

}

function addTimeAndFine() {
    timeAndFine = ""+totalTime + " Bøde | " + totalFine + " DKK";
    //document.getElementById("txtCharges").innerHTML += timeAndFine;
    charges.push(new charge(timeAndFine,0));

    updateTimeAndFine();

    updateChargeTable();
}

function condense()
{
    var getCharges = document.getElementById('txtCharges').innerHTML;
    var getWords = getCharges.split(" ");
    for(var i=0;i<getWords.length;i++)
    {
        if(getWords[i] === "Attempted")
        {
            getWords[i] = "Att"
        }
        else if(getWords[i] === "Accessory")
        {
            getWords[i] = "Acc"
        }
        else if(getWords[i] === "First")
        {
            getWords[i] = "1st"
        }
        else if(getWords[i] === "Second")
        {
            getWords[i] = "2nd"
        }
        else if(getWords[i] === "Third")
        {
            getWords[i] = "3rd"
        }
        else if(getWords[i] === "Grand Theft Auto")
        {
            getWords[i] = "GTA"
        }
/*        else if(getWords[i] === "Controlled")
        {
            getWords[i] = ""
        }
        else if(getWords[i] === "Dangerous")
        {
            getWords[i] = ""
        }
        else if(getWords[i] === "Substance")
        {
            getWords[i] = ""
        }
        else if(getWords[i] === "(CDS)")
        {
            getWords[i] = "CDS"
        }*/
        else if(getWords[i] === "Possession")
        {
            getWords[i] = "Poss"
        }
        else if(getWords[i] === "Causing")
        {
            getWords[i] = "C"
        }
        else if(getWords[i] === "Bodily")
        {
            getWords[i] = "B"
        }
        else if(getWords[i] === "Harm")
        {
            getWords[i] = "H"
        }
        else if(getWords[i] === "Degree")
        {
            getWords[i] = "D"
        }
        else if(getWords[i] === "(Class-1)")
        {
            getWords[i] = "(C-1)"
        }
        else if(getWords[i] === "(Class-1")
        {
            getWords[i] = "(C-1"
        }
        else if(getWords[i] === "(Class-2)")
        {
            getWords[i] = "(C-2)"
        }
        else if(getWords[i] === "Criminal")
        {
            getWords[i] = "Crim"
        }
        else if(getWords[i] === "Registered)")
        {
            getWords[i] = "Regd)"
        }

    }
    for(var i=0;i<getWords.length;i++)
    {
        if(getWords[i] === "")
        {
            getWords.splice(i,2);
        }
    }

    document.getElementById('txtCharges').innerHTML = getWords.join(" ");

    charCount = document.getElementById('txtCharges').innerHTML.length;
    document.getElementById('charCountDiv').innerHTML = '<b>Arrestordre tegngrænse er 255.<br>De nuværende sigtelser bruger '+charCount+' tegn. Sammenfat dem nedeunder.</b>';

    //255 is max amount of characters in warrants

}

function lossSearchFocus()
{
    var reset = document.getElementById("searchCrime");
}

function toggleDescriptions()
{
     var desc = document.getElementsByClassName("description");
     var descName = document.getElementById("btnDescriptions").innerText;
     var table = document.getElementById("mainTable");
     var tr = table.getElementsByTagName("tr");
     var search = document.getElementById("searchCrime");
     var snackBar = document.getElementById("snackbar");

     if(search.value == "")
     {
             if(descName == "Vis Beskrivelse")
             {
                document.getElementById("btnDescriptions").innerText = "Gem Beskrivelse";
                localStorage.setItem("desc", "1");
                //location.reload();
                 for(i=0;i<desc.length;i++)
                 {
                    desc[i].style.display = "";
                 }
             }
             else
              {
                document.getElementById("btnDescriptions").innerText = "Vis Beskrivelse";
                 localStorage.setItem("desc", "0");
                 for(i=0;i<desc.length;i++)
                 {
                    desc[i].style.display = "none";
                 }

              }
     }
     else
     {
        snackBar.innerText = "Kan ikke visse eller gemme beskrivelse mens der søges. Mouseover overtrædelser.";
        snackBar.className = "vis";
        setTimeout(function(){ snackBar.className = snackBar.className.replace("vis", ""); }, 3000);
     }

}

function saveFlipped()
{
    var checked = document.getElementById('chkFlipFine').checked;

    if(checked)
    {
        localStorage.setItem('checkFlipped', "1");
    }
    else
    {
        localStorage.setItem('checkFlipped', "0");
    }

    updateChargeTable();
}

function searchCrimes()
{
 var input = document.getElementById("searchCrime");
 var filter = input.value.toUpperCase();
 var table = document.getElementById("mainTable");
 var tr = table.getElementsByTagName("tr");
 var desc = document.getElementsByClassName("description");
 var descName = document.getElementById("btnDescriptions").innerText;

 for (var i = 0; i < tr.length; i++) {
     var tds = tr[i].getElementsByTagName("td");
     var firstCol = tds[0].textContent.toUpperCase();
     var secondCol = tds[1].textContent.toUpperCase();
     var thirdCol = tds[2].textContent.toUpperCase();
     var forthCol = tds[3].textContent.toUpperCase();

     if (firstCol.indexOf(filter) > -1 || secondCol.indexOf(filter) > -1 || thirdCol.indexOf(filter) > -1 || forthCol.indexOf(filter) > -1)
     {
        if(descName == "Show Descriptions")
        {
            if(tr[i].className == "description")
            {
                tr[i].style.display = "none";
            }
            else
            {
                tr[i].style.display = "";
            }
        }
        else
        {
            tr[i].style.display = "";
        }

     }
     else
     {
         tr[i].style.display = "none";
     }
 }

}

function addDateAndTime() {

var date = new Date();
var gmtMinutes = date.getUTCMinutes() + "";

if(date.getUTCMinutes() < 10)
	{
		gmtMinutes = "0" + gmtMinutes;
	}

var dateAndTime = "[" + (date.getUTCMonth() + 1) + "/" +
	date.getUTCDate() + " - " + date.getUTCHours() + ":" +
	gmtMinutes + " GMT]";

charges.push(new charge(dateAndTime,0));

updateTimeAndFine();

updateChargeTable();

}

function addWarrantTag()
{
    //document.getElementById("txtCharges").value += " [Bail]";
    charges.push(new charge("[Arrestordre Tjent]",0));
    updateTimeAndFine();

    updateChargeTable();
}

function addBailTag()
{
    //document.getElementById("txtCharges").value += " [Bail]";
    charges.push(new charge("[Kaution]",0));
    updateTimeAndFine();

    updateChargeTable();
}

function generateLicense()
{
    var playerID = document.getElementById("playerID").value;
    var callSign = document.getElementById('txtExtras').value;

    if(playerID == 0)
    {
        document.getElementById("showTicket").value = "Spiller ID er blankt...";
    }
    else
    {
    document.getElementById("showTicket").value = "/bill " + playerID + " " + "5000" + " Våben License [Afgift] " + callSign;
    }

}


function addCharge(e) {
var totalCharges = charges.length;
var isNew = true;
var name = e.getAttribute('data-name');
var fine = e.getAttribute('data-fine');
var time = parseInt(e.getAttribute('data-time'));
//var drugTrafficking = document.getElementById('drugTrafficking').value;

  // update existing
  for(var i = 0; i < totalCharges; i++) {
    if(charges[i].name == name) {
      charges[i].count += 1;

	  if(fine != null)
	{
		speedFine += parseInt(fine);
	}

      isNew = false;
    }
  }

  // add new
  if(isNew) {
    if(name == "Possession of Stolen Property")
        {
            charges.push(new charge(name + " (" + " DKK)", time, fine));
        }
    else if(name == "Possession of CDS - First Degree")
        {
            charges.push(new charge(name + " (" + ")", time, fine));
        }
/*    else if(name == "Drug Trafficking" && drugTrafficking != 0)
        {
            charges.push(new charge(name + " (" +drugTrafficking+ ")", time, fine));
        }*/
    else if(name == "Sale of CDS")
        {
            charges.push(new charge(name + " (" + ")", time, fine));
        }
    else if(name == "Criminal Possession of a Firearm (Class-2)")
        {
            charges.push(new charge(name + " (" + ")", time, fine));
        }
    else if(name == "Criminal Sale of a Firearm")
        {
            charges.push(new charge(name + " (" + ")", time, fine));
        }

      else
      {
    	charges.push(new charge(name, time, fine));
      }
	if(fine != null)
	{
		speedFine += parseInt(fine);
	}
  }

    var snackBar = document.getElementById("myPopup");
    var snackBar2 = document.getElementById('myPopup2');
    var snackBar3 = document.getElementById('myPopup3');
    var snackBar4 = document.getElementById('myPopup4');

    clearTimeout(hideMe);

    if(snackBar.style.display == "") {
        snackBar.style.display = "block";
        snackBar.innerText = 'Tilføjet ' + name + ': ' + time + ' Måneder.';
        setTimeout(hidePopup, 2500);
    }
    else if(snackBar.style.display == "none") {
        snackBar.style.display = "block";
        snackBar.innerText = 'Tilføjet ' + name + ': ' + time + ' Måneder.';
        setTimeout(hidePopup,2500);
    }
    else if(snackBar.style.display == "block" && snackBar.style.display != "none" && snackBar2.style.display != "block")
    {
        snackBar2.style.display = "block";
        snackBar2.innerText = 'Tilføjet ' + name + ': ' + time + ' Måneder.';
        setTimeout(hidePopup2,2500);

    }
    else if(snackBar.style.display == "block" && snackBar2.style.display == "block" && snackBar3.style.display != "block")
    {
        snackBar3.style.display = "block";
        snackBar3.innerText = 'Tilføjet ' + name + ': ' + time + ' Måneder.';
        setTimeout(hidePopup3,2500);
    }
    else if(snackBar.style.display == "block" && snackBar2.style.display == "block" && snackBar3.style.display == "block" && snackBar4.style.display != "block")
    {
        snackBar4.style.display = "block";
        snackBar4.innerText = 'Tilføjet ' + name + ': ' + time + ' Måneder.';
        setTimeout(hidePopup4,2500);

    }
  updateTimeAndFine();

  updateChargeTable();
}

function hidePopup()
{
    var snackBar = document.getElementById('myPopup');
    snackBar.style.display = "none";

}

function hidePopup2()
{
    var snackBar2 = document.getElementById('myPopup2');
    snackBar2.style.display = "none";
}

function hidePopup3()
{
    var snackBar3 = document.getElementById('myPopup3');
    snackBar3.style.display = "none";
}

function hidePopup4()
{
    var snackBar4 = document.getElementById('myPopup4');
    snackBar4.style.display = "none";
}


function removeCharge(e) {
  var charge = parseInt(e.getAttribute('data-charge'));
  var name = e.getAttribute('data-name');
  var fine = e.getAttribute('data-fine');

  if(charges[charge].fine != null)
  {
	speedFine -= parseInt(charges[charge].fine);
  }

  if(charges[charge].count > 1) {

    charges[charge].count -= 1;
  }else {
    charges.splice(charge, 1);
  }

  updateTimeAndFine();

  updateChargeTable();
}


function updateTimeAndFine() {
  var totalCharges = charges.length;

  totalTime = 0;

  totalFine = 0;

  for(var i = 0; i < totalCharges; i++) {
    totalTime += charges[i].time * charges[i].count;
    if(charges[i].name === "Tampering With a Vehicle")
    {
        totalFine += (500 * charges[i].time +5000) * charges[i].count;
    }
    else
    {
        totalFine += (500 * charges[i].time) * charges[i].count;
    }

  }

  totalFine += speedFine;
}


function clearAllCharges() {
    var checked = document.getElementById('chkClearExtras').checked;
    charges = [];
    totalTime = 0;
    totalFine = 0;
    speedFine = 0;

    document.getElementById("ticketAmount").value = "";
    document.getElementById("ticketReason").value = "";
    document.getElementById("showTicket").value = "";

    updateChargeTable();

    if(checked)
    {
        document.getElementById('stolenMoney').value = "";
        document.getElementById('disCDS').value = "";
        document.getElementById('possCDS').value = "";
        document.getElementById('illegalWepTrading').value = "";
        document.getElementById('illegalWep').value = "";
    }
}


function generateString() {
  var totalCharges = charges.length;

  var string = '';

  for(var i = 0; i < totalCharges; i++) {
    var totalCount = '';

    if(charges[i].count > 1) {
      totalCount = ' x' + charges[i].count;
    }

	if(i == totalCharges - 1)
	{
		string += charges[i].name + totalCount + " ";
	}
	else
	{
		string += charges[i].name + totalCount +  ' | ';
	}

  }
  return string;
}


function updateChargeTable() {
  var totalCharges = charges.length;
  var isFlipped = false;

  var chargeTable = '';


  if(totalCharges > 0) {

    // Charges table
    chargeTable += '<div class="col-lg-12">';
    chargeTable += '<table class="table table-striped">';
    chargeTable += '<tr><th>#</th><th>Sigtelser</th><th>Tid</th><th></th></tr>';

    for(var i = 0; i < totalCharges; i++) {
      chargeTable += '<tr><td>' + charges[i].count +  '</td><td>' + charges[i].name +  '</td><td>' + charges[i].time +  '</td><td><a href="javascript:void(0);" class="btn btn-warning btn-sm" data-charge="' + i + '" onclick="removeCharge(this)">Fjern</a></td></tr>';
    }

    chargeTable += '</table>';
    chargeTable += '</div>';

    // Totals
    if(!isFlipped)
    {
        if(totalTime >= 30 && totalTime < 60)
        	{
        		chargeTable += '<div class="col-lg-6 text-center"><h2 class="well">' + totalTime + ' <small>Måneder <i class="material-icons" style="color:blue" data-html="true" data-toggle="tooltip" title="Lille straf</b>"></i></small></h2></div>';
        	}
        	else if(totalTime >= 60 && totalTime < 90)
        	{
        		chargeTable += '<div class="col-lg-6 text-center"><h2 class="well">' + totalTime + ' <small>Måneder <i class="material-icons" style="color:orange" data-html="true" data-toggle="tooltip" title="Mellem advarsel</b>"></i></small></h2></div>';
        	}
        	else if(totalTime >= 90)
        	{
        		chargeTable += '<div class="col-lg-6 text-center"><h2 class="well">' + totalTime + ' <small>Måneder <i class="material-icons" style="color:red" data-html="true" data-toggle="tooltip" title="Stor Straf</b>"></i></small></h2></div>';
        	}
        	else
        	{
        		chargeTable += '<div class="col-lg-6 text-center"><h2 class="well">' + totalTime + ' <small>Måneder</small></h2></div>';
        	}
            chargeTable += '<div class="col-lg-6 text-center"><h2 class="well">' + totalFine + ' DKK</h2></div>';
    }
    else
    {
        chargeTable += '<div class="col-lg-6 text-center"><h2 class="well">' + totalFine + ' DKK</h2></div>';
        if(totalTime >= 30 && totalTime < 60)
            {
                chargeTable += '<div class="col-lg-6 text-center"><h2 class="well">' + totalTime + ' <small>Måneder <i class="material-icons" data-toggle="tooltip" style="color:blue" data-html="true" title="Lille straf</b>"></i></small></h2></div>';
            }
            else if(totalTime >= 60 && totalTime < 90)
            {
                chargeTable += '<div class="col-lg-6 text-center"><h2 class="well">' + totalTime + ' <small>Måneder <i class="material-icons" data-toggle="tooltip" style="color:orange" data-html="true" title="Mellem Straf</b>"></i></small></h2></div>';
            }
            else if(totalTime >= 90)
            {
                chargeTable += '<div class="col-lg-6 text-center"><h2 class="well">' + totalTime + ' <small>Måneder <i class="material-icons" data-toggle="tooltip" style="color:red" data-html="true" title="Stor Straf</b>"></i></small></h2></div>';
            }
            else
            {
                chargeTable += '<div class="col-lg-6 text-center"><h2 class="well">' + totalTime + ' <small>Måneder</small></h2></div>';
            }

        $(function ()
        {
            $('[data-toggle="tooltip"]').tooltip({trigger:"hover"})
        });

    }


    // Input field
    chargeTable += '<div id="getChargeTable" class="col-lg-12"><div class="well"><textarea id="txtCharges" rows="5" class="form-control">' + generateString() + '</textarea></div></div>';

   } else {
    chargeTable = '<p>Der er ingen sigtelser</p>';
  }

  document.getElementById('charge-table').innerHTML = chargeTable;

    var rightTable = document.getElementById('crimesTable');

    var getBounds = rightTable.getBoundingClientRect();

    if(getBounds.bottom > window.innerHeight || getBounds.top < 0)
    {
        rightTable.className = "col-lg-4 theyAllFloat stopScroll";

    }
    else
    {
        rightTable.className = "col-lg-4 theyAllFloat";
    }

    var elementExists = document.getElementById("txtCharges");

    if (elementExists)
    {
        if(document.getElementById('txtCharges').innerHTML != null)
        {
            charCount = document.getElementById('txtCharges').innerHTML.length;
        }
    }

}

function copyTicket()
{
    var ticket = document.getElementById('showTicket');
    ticket.select();
    document.execCommand("Copy");
}

function copyToClipboard()
{
    var copyCharges = document.getElementById("txtCharges");
    copyCharges.select();
    document.execCommand("Copy");
}

