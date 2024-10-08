// تخزين بيانات المستخدم في قاعدة البيانات
let register_form = document.getElementById("register_form");
if (register_form) {
  let error_validation = document.querySelector(".error_validation");
  register_form.addEventListener("submit", function (e) {
    e.preventDefault();
    let username = document.getElementById("username");
    let email = document.getElementById("email");
    let password = document.getElementById("password");
    let password_confirmation = document.getElementById(
      "password_confirmation"
    );

    if (
      !username.value ||
      !email.value ||
      !password.value ||
      !password_confirmation.value ||
      password.value != password_confirmation.value
    ) {
      error_validation.classList.add("error_active");
    }

    username.style.border = "2px solid var(--mainColor)";
    email.style.border = "2px solid var(--mainColor)";
    password.style.border = "2px solid var(--mainColor)";
    password_confirmation.style.border = "2px solid var(--mainColor)";

    // التحقق من القيم المدخلة
    if (!username.value) {
      username.focus();
      username.style.border = "2px solid red";
      error_validation.innerHTML = "اسم المستخدم مطلوب.";
      return;
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

    if (password.value.length < 7) {
      password.focus();
      password.style.border = "2px solid red";
      error_validation.innerHTML =
        "كلمة المرور يجب ان تكون اكبر من 7 حروف او ارقام.";
      return;
    }

    if (!password_confirmation.value) {
      password_confirmation.focus();
      password_confirmation.style.border = "2px solid red";
      error_validation.innerHTML = "تأكيد كلمة المرور مطلوب.";
      return;
    }

    // التحقق من تطابق كلمة المرور مع التأكيد
    if (password.value !== password_confirmation.value) {
      password_confirmation.focus();
      password.style.border = "2px solid red";
      password_confirmation.style.border = "2px solid red";
      error_validation.innerHTML = "كلمات المرور لا تتطابق.";
      return;
    }

    // إعداد البيانات لإرسالها
    let data = {
      username: username.value,
      email: email.value,
      password: password.value,
      password_confirmation: password_confirmation.value,
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
              location.href = "./";
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

    xhr.open("POST", `./includes/database/register.php?request=register`, true);
    xhr.setRequestHeader("Content-Type", "application/json");
    xhr.send(JSON.stringify(data));
  });
}
