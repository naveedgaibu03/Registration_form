document.addEventListener("DOMContentLoaded", function () {
  const form = document.getElementById("registrationForm");
  form.addEventListener("submit", function (e) {
    e.preventDefault();
    if (validateForm()) {
      submitForm();
    }
  });

  function validateForm() {
    const name = document.getElementById("name").value;
    const dob = document.getElementById("dob").value;

    // Basic validation - add more as needed
    if (name.trim() === "") {
      alert("Please enter your name.");
      return false;
    }

    if (dob === "") {
      alert("Please enter your Date of Birth.");
      return false;
    }

    return true;
  }

  function submitForm() {
    const formData = new FormData(form);

    fetch("process_form.php", {
      method: "POST",
      body: formData,
    })
      .then((response) => {
        if (response.ok) {
          return response.text();
        } else {
          throw new Error("Form submission failed.");
        }
      })
      .then((data) => {
        // Handle the response from the server (e.g., display a success message)
        alert("Form submitted successfully: " + data);
        form.reset();
      })
      .catch((error) => {
        alert("Form submission error: " + error.message);
      });
  }
});
