function changeSignLogin(){
  const sorl = document.getElementById("")
  console.log(sorl.textContent)
  if(sorl.textContent == "Login"){
    document.getElementById("logOrsign").innerHTML = "Sign Up"
    document.getElementById("logsign").innerHTML = "Sign Up"
    const divElements = document.getElementsByClassName("forget");
    for (let i = 0; i < divElements.length; i++) {
      divElements[i].style.display = 'none';
    }
    document.getElementById("ptext").innerHTML = "Have an account already?"
    document.getElementById("atext").innerHTML = "Login"
  } else if(sorl.textContent == "Sign Up") {
    location.reload();
  }
}
