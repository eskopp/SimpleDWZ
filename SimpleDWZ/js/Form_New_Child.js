function validateInputText(input) {
  input.value = input.value.replace(/[^A-Za-z]/g, "");
}

function validateInputZahl(input) {
  input.value = input.value.replace(/[^0-9]/g, "");
}
