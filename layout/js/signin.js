// التحقق من بيانات المستخدم في قاعدة البيانات
let signin_form = document.getElementById("signin_form");
if (signin_form) {
  signin_form.addEventListener("submit", function (e) {
    e.preventDefault();
    let error_validation = document.querySelector(".error_validation");
    let email = document.getElementById("email");
    let password = document.getElementById("password");

    email.style.border = "2px solid var(--mainColor)";
    password.style.border = "2px solid var(--mainColor)";

    if (!email.value || !password.value) {
      error_validation.classList.add("error_active");
    }

    if (!email.value) {
      email.focus();
      email.style.border = "2px solid red";
      error_validation.innerHTML = "البريد الإلكتروني مطلوب.";
      return;
    }

    if (!password.value) {
      password.focus();
      password.style.border = "2px solid red";
      error_validation.innerHTML = "كلمة المرور مطلوبة.";
      return;
    }

    // إعداد البيانات لإرسالها
    let data = {
      email: email.value,
      password: password.value,
    };

    let xhr = new XMLHttpRequest();
    xhr.onreadystatechange = () => {
      if (xhr.readyState == 4) {
        if (xhr.status == 200) {
          let response = JSON.parse(xhr.responseText);
          let error_validation = document.querySelector(".error_validation");

          if (response.status == "success") {
            error_validation.innerHTML = response.message;
            error_validation.classList.remove("error_active");
            error_validation.classList.add("success_active");

            setTimeout(() => {
              error_validation.classList.remove("success_active");
              location.href = "./home.php";
            }, 1000);
          } else {
            error_validation.innerHTML = response.message;
            error_validation.classList.add("error_active");
            error_validation.classList.remove("success_active");
            setTimeout(() => {
              error_validation.classList.remove("error_active");
            }, 2000);
          }
        } else {
          console.error("Error: " + xhr.status);
          error_validation.innerHTML = "في مشكله! جرب مره أخري.";
          error_validation.classList.add("error_active");
          error_validation.classList.remove("success_active");

          setTimeout(() => {
            error_validation.classList.remove("error_active");
          }, 2000);
        }
      }
    };

    xhr.open("POST", `./includes/database/signin.php?request=signin`, true);
    xhr.setRequestHeader("Content-Type", "application/json");
    xhr.send(JSON.stringify(data));
  });
}
