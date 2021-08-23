const stringRegex = /^[a-zA-Z]+$/;
const emailRegex = /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;

function validate(validRegex, errorText, input) {
  const isValid = validRegex.test(input.value);
  const errorElem = document.getElementById(`error-${input.id}`);
  if (!isValid) {
    input.style["border-bottom"] = "2px solid #e00202";
    input.style.color = "#e00202";
    errorElem.innerHTML = `<span style="text-transform: capitalize">${input.id}</span> ${errorText}.`;
  } else {
    input.style["border-bottom"] = "1px solid #333";
    input.style.color = "#333";
    errorElem.innerHTML = "";
  }
  return isValid;
}

function validateString(input) {
  return validate(stringRegex, "should be contain strings only", input);
}

function validateMail(input) {
  return validate(
    emailRegex,
    "should have a format similar to that a-z@example.com",
    input
  );
}

function checkForm() {
  const isFirstnameValid = stringRegex.test(
    document.getElementById("firstname").value
  );
  const isLastnameValid = stringRegex.test(
    document.getElementById("lastname").value
  );
  const isMailValid = emailRegex.test(document.getElementById("mail").value);
  const submitButton = document.getElementsByClassName("submit-button")[0];
  if (!isFirstnameValid || !isLastnameValid || !isMailValid) {
    submitButton.disabled = true;
  } else {
    submitButton.disabled = false;
  }
}

function checkLogin() {
  const isMailValid = emailRegex.test(document.getElementById("mail").value);
  const isPasswordValid = !!document.getElementById("password").value;
  const submitButton = document.getElementsByClassName("submit-button")[0];
  if (!isMailValid || !isPasswordValid) {
    submitButton.disabled = true;
  } else {
    submitButton.disabled = false;
  }
}

function closeNavbar(e) {
  document.getElementById("menu").checked = false;
}

function toggleSwipeButton(e) {
  const current = document.getElementById("swipe-button").href;
  const splitted = current.split("/");
  const href = splitted[splitted.length - 1];

  if (href === "" || href === "#home") {
    document.getElementById("swipe-button").href = "#actions-section";
    document.getElementById("swipe-button").style.transform = "rotate(180deg)";
  } else {
    document.getElementById("swipe-button").href = "#home";
    document.getElementById("swipe-button").style.transform = "rotate(0)";
  }
}
