function register1()
{   
    var fname = document.register.fname.value;
    var lname = document.register.lname.value;
    var email = document.register.email.value;
    var pass = document.register.pwd.value;
    var rpass = document.register.rpwd.value;
    var card = document.register.card.value;

    if(fname=="" ||lname=="" || email=="" || pass=="" || rpass=="")
    {
        alert ("Please fill in the details");
    }
    else if(card.length != 16)
    {
      alert("Invalid card number");
    }
    else
    {
        var check = checkpassword(pass , rpass);
        var checkMail = ValidateEmail(email);

        if(check == false)
            alert("The passwords don't match");
        else if(checkMail == false)
            alert("Please enter a valid email");
        else{
          console.log(card);
          document.location = "index.php?fname="+fname+"&lname="+lname+"&email="+email+"&pwd="+pass+"&card="+card+"&value=register";
        }

    }
}

function login1()
{
  var email = document.login.email.value;
  var pass = document.login.pass.value;

  var checkMail = ValidateEmail(email);

  if( email=="" || pass=="")
  {
    alert("Please enter all the details");
  }
  else if(checkMail == false)
  {
    alert("Enter valid email");
  }
  else
  {
    document.location = "index.php?email="+email+"&pass="+pass+"&value=login";
  }
}

function addDoctors1()
{
  var name = document.addDoc.dname.value;
  var surname = document.addDoc.dsurname.value;
  var spec = document.addDoc.spec.value;
  var fee = document.addDoc.fee.value;
  var date = document.addDoc.date.value;
  var from = document.addDoc.timefrom.value;
  var to = document.addDoc.timeto.value;
  if(name=="" || surname=="" || spec=="" || fee=="" || date=="" || from=="" || to=="")
  {
    alert("Fill all the details");
  }
  else
  {
    document.location = "index.php?dname="+name+"&dsurname="+surname+"&spec="+spec+"&fee="+fee+"&date="+date+"&timefrom="+from+"&timeto="+to+"&value=addDoc";
    alert("You've added successfuly a new doctor");
  }
}

function ValidateEmail(mail) 
{
 if (/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(mail))
  {
    return (true)
  }
    return (false)
}


function checkpassword(pass1 , pass2)
{
    if(pass1 == pass2)
    return true;
    else
    return false;
}
function show_hide_reg() {
    var reg = document.getElementById("reg");
    var log = document.getElementById("log");
    if (reg.style.display == "none") {
      reg.style.display = "block";
      log.style.display = "none";
    } else {
        reg.style.display = "none";
        log.style.display = "none";
    }
  }

  function show_hide_log() {
    var reg = document.getElementById("reg");
    var log = document.getElementById("log");
    if (log.style.display == "none") {
      log.style.display = "block";
      reg.style.display = "none";
    } else {
        log.style.display = "none";
        reg.style.display = "none";
    }
  }

  function addDoc1()
  {
    var add = document.getElementById("add");
    var edit = document.getElementById("edit");
    var del = document.getElementById("delete");
    if(add.style.display == "none")
    {
      add.style.display = "block";
      edit.style.display = "none";
      del.style.display = "none";
    }
    else
    {
      add.style.display = "none";
      edit.style.display = "none";
      del.style.display = "none";
    }
  }
  function editDoc()
  {
    var add = document.getElementById("add");
    var edit = document.getElementById("edit");
    var del = document.getElementById("delete");
    if(edit.style.display == "none")
    {
      add.style.display = "none";
      edit.style.display = "block";
      del.style.display = "none";
    }
    else
    {
      add.style.display = "none";
      edit.style.display = "none";
      del.style.display = "none";
    }
  }

  function editDB(id){
    var name = document.editDocDB2.dname.value;
    var surname = document.editDocDB2.dsurname.value;
    var spec = document.editDocDB2.spec.value;
    var fee = document.editDocDB2.fee.value;
    var date = document.editDocDB2.date.value;
    var from = document.editDocDB2.timefrom.value;
    var to = document.editDocDB2.timeto.value;

    console.log(from);
    
    if(name=="" || surname=="" || spec=="" || fee=="" || date=="" || from=="" || to=="")
    {
      alert("Fill all the details");
    }
    else
    {
      document.location = "index.php?dname="+name+"&dsurname="+surname+"&spec="+spec+"&fee="+fee+"&date="+date+"&timefrom="+from+"&timeto="+to+"&id="+id+"&value=editDocDB";
      //document.location = "index.php?value=editDocDB";
      alert("You've successfuly edited a doctor's information");
    }
  }

  function delDoc()
  {
    var add = document.getElementById("add");
    var edit = document.getElementById("edit");
    var del = document.getElementById("delete");
    if(del.style.display == "none")
    {
      add.style.display = "none";
      edit.style.display = "none";
      del.style.display = "block";
    }
    else
    {
      add.style.display = "none";
      edit.style.display = "none";
      del.style.display = "none";
    }
  }

  function delDocDB(docID) {
    document.location = "index.php?id="+docID+"&value=delete";
  }

  function bookDoc(docid, userid, date)
  {
    alert("You have booked an appointment successfully at next "+date);
    document.location = "index.php?docid="+docid+"&userid="+userid+"&value=bookDoc";
  }
  
  function search() {
    var key = document.getElementById("search").value;
    
    document.location = "index.php?key="+key+"&value=search";
    
  }
  
  function poplogin()
  {
    alert("Please login first")
  }

  function cancelApp(appID){
    if (confirm('Are you sure you want to cancel this apointment?')) {
      document.location = "index.php?appID="+appID+"&value=cancelApp";
    } 
    else {
      
    }
  }