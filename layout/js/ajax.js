let insert_plan = document.getElementById("insert_plan");
if (insert_plan) {
  document
    .getElementById("insert_plan_form")
    .addEventListener("submit", function (e) {
      e.preventDefault();
      let error_validation = document.querySelector(".error_validation");
      let retirement_age = document.getElementById("retirement_age");
      let user_old = document.getElementById("user_old");
      let monthly_amount = document.getElementById("monthly_amount");
      let goal_retirement = document.getElementById("goal_retirement");
      let goal_type = document.getElementById("goal_type");

      if (
        !retirement_age.value ||
        !user_old.value ||
        !monthly_amount.value ||
        !goal_retirement.value ||
        !goal_type.value
      ) {
        error_validation.classList.add("error_active");
      }

      if (!retirement_age.value) {
        retirement_age.focus();
        error_validation.innerHTML = "عمر التقاعد مطلوب.";
        return;
      }

      if (!user_old.value) {
        user_old.focus();
        error_validation.innerHTML = "عمرك مطلوب.";
        return;
      }

      if (!monthly_amount.value) {
        monthly_amount.focus();
        error_validation.innerHTML = "القسط الشهري مطلوب.";
        return;
      }

      if (!goal_retirement.value) {
        goal_retirement.focus();
        error_validation.innerHTML = "هدف التقاعد مطلوب.";
        return;
      }

      if (!goal_type.value) {
        goal_type.focus();
        error_validation.innerHTML = "نوع هدف التقاعد مطلوب.";
        return;
      }

      let data = {
        retirement_age: retirement_age.value,
        user_old: user_old.value,
        monthly_amount: monthly_amount.value,
        goal_retirement: goal_retirement.value,
        goal_type: goal_type.value,
      };

      insertData("plan", data, "تم إنشاء خطة التقاعد!");
    });
}

let insert_debt = document.getElementById("insert_debt");
if (insert_debt) {
  let debt_amount = document.getElementById("debt_amount");
  let debt_monthly = document.getElementById("debt_monthly");
  let duration = document.getElementById("duration");

  document.getElementById("insert_debt_form").addEventListener("input", () => {
    if (debt_amount.value && debt_monthly.value && debt_monthly.value != 0) {
      duration.value = Math.ceil(debt_amount.value / debt_monthly.value);
    } else if (
      !debt_amount.value ||
      !debt_monthly.value ||
      debt_monthly.value == 0
    ) {
      duration.value = 0;
    }
  });

  document
    .getElementById("insert_debt_form")
    .addEventListener("submit", function (e) {
      e.preventDefault();
      let error_validation = document.querySelector(".error_validation");
      let debt_type = document.getElementById("debt_type");

      if (
        !debt_type.value ||
        !debt_amount.value ||
        !debt_monthly.value ||
        !duration.value
      ) {
        error_validation.classList.add("error_active");
      }

      if (!debt_type.value) {
        debt_type.focus();
        error_validation.innerHTML = "نوع الدين مطلوب.";
        return;
      }

      if (!debt_amount.value) {
        debt_amount.focus();
        error_validation.innerHTML = "كمية الدين مطلوبة.";
        return;
      }

      if (!debt_monthly.value) {
        debt_monthly.focus();
        error_validation.innerHTML = "القسط الشهري مطلوب.";
        return;
      }

      if (!duration.value) {
        duration.focus();
        error_validation.innerHTML = "مدة التأخير مطلوب.";
        return;
      }

      let data = {
        debt_type: debt_type.value,
        debt_amount: debt_amount.value,
        debt_monthly: debt_monthly.value,
        duration: duration.value,
      };

      insertData("debt", data, "تم إنشاء الدين!");
    });
}

let insert_budget = document.getElementById("insert_budget");
if (insert_budget) {
  let monthly_amount = document.getElementById("monthly_amount");
  let expenses = document.getElementById("expenses");
  let goal_amount = document.getElementById("goal_amount");
  let duration = document.getElementById("duration");

  document
    .getElementById("insert_budget_form")
    .addEventListener("input", () => {
      if (monthly_amount.value && expenses.value && expenses.value != 0) {
        duration.value = Math.ceil(
          goal_amount.value / (monthly_amount.value - expenses.value)
        );
      } else if (
        !monthly_amount.value ||
        !expenses.value ||
        expenses.value == 0
      ) {
        duration.value = 0;
      }
    });

  document
    .getElementById("insert_budget_form")
    .addEventListener("submit", function (e) {
      e.preventDefault();
      let error_validation = document.querySelector(".error_validation");

      if (
        !monthly_amount.value ||
        !expenses.value ||
        !goal_amount.value ||
        !duration.value
      ) {
        error_validation.classList.add("error_active");
      }

      if (!monthly_amount.value) {
        monthly_amount.focus();
        error_validation.innerHTML = "الدخل الشهري مطلوب.";
        return;
      }
      if (!expenses.value) {
        expenses.focus();
        error_validation.innerHTML = "المصروفات مطلوبة.";
        return;
      }
      if (!goal_amount.value) {
        goal_amount.focus();
        error_validation.innerHTML = "مبلغ الهدف مطلوب.";
        return;
      }
      if (!duration.value) {
        duration.focus();
        error_validation.innerHTML = "المدة مطلوبة.";
        return;
      }

      let data = {
        monthly_amount: monthly_amount.value,
        expenses: expenses.value,
        goal_amount: goal_amount.value,
        duration: duration.value,
      };

      insertData("budget", data, "تم إنشاء الميزانية!");
    });
}

let register = document.getElementById("register");
if (register) {
  document
    .getElementById("register_user")
    .addEventListener("submit", function (e) {
      e.preventDefault();
      let error_validation = document.querySelector(".error_validation");
      let username = document.getElementById("username");
      let email = document.getElementById("email");
      let password = document.getElementById("password");
      let password_confirmation = document.getElementById(
        "password_confirmation"
      );
      let currency = document.getElementById("currency");

      if (
        !username.value ||
        !email.value ||
        !password.value ||
        !password_confirmation.value ||
        password.value != password_confirmation.value ||
        !currency.value
      ) {
        error_validation.classList.add("error_active");
      }

      // تحقق من القيم المدخلة
      if (!username.value) {
        username.focus();
        error_validation.innerHTML = "اسم المستخدم مطلوب.";
        return;
      }

      if (!email.value) {
        email.focus();
        error_validation.innerHTML = "البريد الإلكتروني مطلوب.";
        return;
      }

      if (!password.value) {
        password.focus();
        error_validation.innerHTML = "كلمة المرور مطلوبة.";
        return;
      }

      if (!password_confirmation.value) {
        password_confirmation.focus();
        error_validation.innerHTML = "تأكيد كلمة المرور مطلوب.";
        return;
      }

      if (!currency.value) {
        currency.focus();
        error_validation.innerHTML = "العملة مطلوبة.";
        return;
      }

      // تحقق من تطابق كلمة المرور مع التأكيد
      if (password.value !== password_confirmation.value) {
        password_confirmation.focus();
        error_validation.innerHTML = "كلمات المرور لا تتطابق.";
        return;
      }

      // إعداد البيانات لإرسالها
      let data = {
        username: username.value,
        email: email.value,
        password: password.value,
        password_confirmation: password_confirmation.value,
        currency: currency.value,
      };

      setTimeout(() => {
        location.href = "./";
      }, 1000);

      insertData("register", data, "تم إنشاء الحساب!");
    });
}

let signin = document.getElementById("signin");
if (signin) {
  document
    .getElementById("signin_user")
    .addEventListener("submit", function (e) {
      e.preventDefault();
      let error_validation = document.querySelector(".error_validation");
      let email = document.getElementById("email");
      let password = document.getElementById("password");

      if (!email.value || !password.value) {
        error_validation.classList.add("error_active");
      }

      if (!email.value) {
        email.focus();
        error_validation.innerHTML = "البريد الإلكتروني مطلوب.";
        return;
      }

      if (!password.value) {
        password.focus();
        error_validation.innerHTML = "كلمة المرور مطلوبة.";
        return;
      }

      // إعداد البيانات لإرسالها
      let data = {
        email: email.value,
        password: password.value,
      };

      insertData("signin", data, "تم تسجيل الدخول!");
    });
}

function insertData(requestType, data, successMessage) {
  let xhr = new XMLHttpRequest();
  xhr.onreadystatechange = () => {
    if (xhr.readyState == 4) {
      let error_validation = document.querySelector(".error_validation");
      if (xhr.status == 200) {
        console.log(xhr.responseText);
        let response = JSON.parse(xhr.responseText);
        if (response.status == "success") {
          error_validation.innerHTML = successMessage;
          Object.keys(data).forEach((key) => {
            document.getElementById(key).value = "";
          });
          error_validation.classList.remove("error_active");
          error_validation.classList.add("success_active");

          setTimeout(() => {
            error_validation.classList.remove("success_active");
          }, 3000);

          setTimeout(() => {
            if (requestType == "plan") {
              location.href = "./services.php?page=plan_details";
            }
            if (requestType == "debt") {
              location.href = "./services.php?page=debts_details";
            }
            if (requestType == "budget") {
              location.href = "./services.php?page=budget";
            }
            if (requestType == "signin") {
              location.href = "./";
            }
          }, 1000);
        } else {
          error_validation.innerHTML = response.message;
        }
      } else {
        console.error("Error: " + xhr.status);
        error_validation.innerHTML = "في مشكله! جرب مره أخري.";
      }
    }
  };

  xhr.open(
    "POST",
    `./includes/database/ajax_server.php?request=${requestType}`,
    true
  );
  xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
  xhr.send(new URLSearchParams(data).toString());
}

let profile_form = document.getElementById("profile_form");

if (profile_form) {
  let profile_submit = document.getElementById("profile_submit");

  profile_form.addEventListener("keyup", () => {
    profile_submit.classList.remove("disabled");
  });

  profile_form.addEventListener("change", () => {
    profile_submit.classList.remove("disabled");
  });
}
