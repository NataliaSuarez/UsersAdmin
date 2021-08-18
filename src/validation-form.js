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

function checkForm(form) {
  const isFirstnameValid = stringRegex.test(
    document.getElementById("firstname").value
  );
  const isLastnameValid = stringRegex.test(
    document.getElementById("lastname").value
  );
  const isMailValid = emailRegex.test(document.getElementById("mail").value);

  const submitButton = document.getElementsByClassName("submit-button")[0];
  console.log(submitButton);
  if (!isFirstnameValid || !isLastnameValid || !isMailValid) {
    submitButton.disabled = true;
  } else {
    submitButton.disabled = false;
  }
}