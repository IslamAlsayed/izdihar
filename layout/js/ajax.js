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

let save = document.getElementById("save");
if (save) {
  let debt_type = document.getElementById("debt_type");
  let expenses = document.getElementById("expenses");
  let monthly_payment = document.getElementById("monthly_payment");
  let duration = document.getElementById("duration");

  document.getElementById("insert_debt_form").addEventListener("input", () => {
    if (expenses.value && monthly_payment.value && monthly_payment.value != 0) {
      duration.value = Math.ceil(expenses.value / monthly_payment.value);
    } else if (
      !expenses.value ||
      !monthly_payment.value ||
      monthly_payment.value == 0
    ) {
      duration.value = 0;
    }
  });

  document
    .getElementById("insert_debt_form")
    .addEventListener("submit", function (e) {
      e.preventDefault();
      let error_validation = document.querySelector(".error_validation");

      if (
        !debt_type.value ||
        !expenses.value ||
        !monthly_payment.value ||
        !duration.value
      ) {
        error_validation.classList.add("error_active");
      }

      if (!debt_type.value) {
        debt_type.focus();
        error_validation.innerHTML = "نوع الدين مطلوب.";
        return;
      }

      if (!expenses.value) {
        expenses.focus();
        error_validation.innerHTML = "كمية الدين مطلوبة.";
        return;
      }

      if (!monthly_payment.value) {
        monthly_payment.focus();
        error_validation.innerHTML = "القسط الشهري مطلوب.";
        return;
      }

      if (!duration.value) {
        duration.focus();
        error_validation.innerHTML = "المدة مطلوب.";
        return;
      }

      let data = {
        debt_type: debt_type.value,
        expenses: expenses.value,
        monthly_payment: monthly_payment.value,
        duration: duration.value,
      };

      insertData("debt", data, "تم إنشاء الدين!");
    });
}

// let insert_budget = document.getElementById("insert_budget");
// if (insert_budget) {
//   let monthly_income = document.getElementById("monthly_income");
//   let expenses = document.getElementById("expenses");
//   let selling_goal = document.getElementById("selling_goal");
//   let target_type = document.getElementById("target_type");
//   let duration = document.getElementById("duration");

//   document
//     .getElementById("insert_budget_form")
//     .addEventListener("keyup", () => {
//       if (monthly_income.value && expenses.value && selling_goal.value) {
//         duration.value = Math.ceil(
//           selling_goal.value / (monthly_income.value - expenses.value)
//         );
//       } else if (
//         monthly_income.value ||
//         expenses.value ||
//         expenses.value == 0
//       ) {
//         duration.value = 0;
//       }
//     });

//   document
//     .getElementById("insert_budget_form")
//     .addEventListener("submit", function (e) {
//       e.preventDefault();
//       let error_validation = document.querySelector(".error_validation");

//       error_validation.classList.add("error_active");

//       if (!monthly_income.value) {
//         monthly_income.focus();
//         error_validation.innerHTML = "الدخل الشهري مطلوب.";
//         return;
//       }
//       if (!expenses.value) {
//         expenses.focus();
//         error_validation.innerHTML = "المصروفات مطلوبة.";
//         return;
//       }
//       if (!selling_goal.value) {
//         selling_goal.focus();
//         error_validation.innerHTML = "سعر الهدف مطلوب.";
//         return;
//       }
//       if (!target_type.value) {
//         target_type.focus();
//         error_validation.innerHTML = "الهدف مطلوبة.";
//         return;
//       }
//       if (!duration.value) {
//         duration.focus();
//         error_validation.innerHTML = "المدة مطلوبة.";
//         return;
//       }

//       let data = {
//         monthly_income: monthly_income.value,
//         expenses: expenses.value,
//         selling_goal: selling_goal.value,
//         target_type: target_type.value,
//         duration: duration.value,
//       };

//       insertData("budget", data, "تم إنشاء الميزانية!");
//     });
// }

// let insert_budget = document.getElementById("insert_budget");
// if (insert_budget) {
//   document
//     .getElementById("insert_budget_form")
//     .addEventListener("submit", function (e) {
//       e.preventDefault();

//       let error_validation = document.querySelector(".error_validation");
//       error_validation.classList.add("error_active");
//       let array_expenses = document.querySelectorAll(
//         "input[name='expenses[]']"
//       );
//       let monthly_income1 = document.querySelector(
//         "input[name='monthly_income1']"
//       );
//       let monthly_income2 = document.querySelector(
//         "input[name='monthly_income2']"
//       );
//       let budget_goal = document.querySelector("input[name='budget_goal']");
//       let expenses = document.querySelector("input[name='expenses']");
//       let goal_date = document.querySelector("input[name='goal_date']");
//       let selling_goal = document.querySelector("input[name='selling_goal']");

//       // تحويل المدخلات إلى مصفوفة وجلب القيم
//       let expenseValues = Array.from(array_expenses)
//         .map((input) => input.value)
//         .filter((value) => value.trim() !== "");

//       if (!monthly_income1.value) {
//         monthly_income1.focus();
//         error_validation.innerHTML = "الدخل الشهري مطلوب!";
//         return;
//       } else if (expenseValues.length <= 0) {
//         array_expenses[1].focus();
//         error_validation.innerHTML = "اجمالي المصروفات مطلوب!";
//         return;
//       }

//       monthly_income2.value = monthly_income1.value;

//       if (budget_goal.length <= 0) {
//         budget_goal.focus();
//         error_validation.innerHTML = "الهدف مطلوب!";
//         return;
//       } else if (expenses.length <= 0) {
//         expenses.focus();
//         error_validation.innerHTML = "المصروفات مطلوب!";
//         return;
//       } else if (goal_date.length <= 0) {
//         goal_date.focus();
//         error_validation.innerHTML = "مبلغ الهدف مطلوب!";
//         return;
//       } else if (selling_goal.length <= 0) {
//         selling_goal.focus();
//         error_validation.innerHTML = "سعر الهدف مطلوبة!";
//         return;
//       }

//       const firstRow = document.querySelector(".row");
//       const secondRow = document.querySelector(".row.hide");

//       if (firstRow && secondRow) {
//         firstRow.classList.add("hide");
//         secondRow.classList.remove("hide");
//       }

//       setTimeout(() => {
//         firstRow.style.display = "none";
//         error_validation.classList.remove("error_active");
//       }, 150);

//       let data = {
//         monthly_income: monthly_income.value,
//         expenses: expenses.value,
//         selling_goal: selling_goal.value,
//         target_type: target_type.value,
//         duration: duration.value,
//       };

//       insertData("budget", data, "تم إنشاء الميزانية!");

//       setTimeout(() => {
//         error_validation.classList.remove("error_active");
//       }, 2000);
//     });
// }

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
              location.href = "./services.php?page=budgets_details";
            }
            if (requestType == "register") {
              location.href = "./";
            }
            if (requestType == "signin") {
              location.href = "./home.php";
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

// Function debts
let fa_minuses = document.querySelectorAll(".tbody .fa-minus");
fa_minuses.forEach((minus) => {
  minus.addEventListener("click", () => {
    console.log(minus.dataset.debt_id);
    updatedData("trash", minus.dataset.debt_id);

    // let payment = minus.closest(".row").nextElementSibling;
    // minus.classList.toggle("fa-rotate-180");
    // if (payment) payment.classList.toggle("show");
  });
});

let fa_chevron_downs = document.querySelectorAll(".tbody .fa-chevron-down");
fa_chevron_downs.forEach((chevron) => {
  chevron.addEventListener("click", () => {
    let payment = chevron.closest(".row").nextElementSibling;
    chevron.classList.toggle("fa-rotate-180");
    if (payment) payment.classList.toggle("show");
  });
});

let update_debts = document.querySelectorAll(".update_debt");
update_debts.forEach((debt) => {
  debt.addEventListener("click", () => {
    debt.classList.add("fa-check");
    debt.classList.add("disabled");
    debt.classList.remove("fa-circle");
    updatedData("check", debt.dataset.debt_id);
  });
});

function updatedData(requestType, id) {
  let xhr = new XMLHttpRequest();
  xhr.onreadystatechange = () => {
    if (xhr.readyState == 4) {
      let customAlert = document.querySelector(".customAlert");
      if (xhr.status == 200) {
        let response = JSON.parse(xhr.responseText);
        console.log(response);
        if (response.status == "success") {
          customAlert.innerHTML = response.message;
          customAlert.classList.add("success");

          if (requestType == "check") {
            document.querySelector(
              `.expenses_${id}`
            ).innerHTML = `${response.data.total_expenses} ر.س`;
          } else if (requestType == "trash") {
            document.getElementById(`debt_${id}`).remove();
          }

          setTimeout(() => {
            customAlert.classList.remove("success");
          }, 1000);
        } else {
          customAlert.innerHTML = response.message;
        }
      } else {
        console.error("Error: " + xhr.status);
        customAlert.innerHTML = "في مشكلة! جرب مرة أخرى.";
      }
    }
  };

  xhr.open(
    "POST",
    `./includes/database/debts.php?request=${requestType}`,
    true
  );
  xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
  xhr.send("id=" + encodeURIComponent(id));
}
