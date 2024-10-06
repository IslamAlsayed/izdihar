let insert_plan = document.getElementById("insert_plan");
if (insert_plan) {
  document
    .getElementById("insert_plan_form")
    .addEventListener("submit", function (e) {
      e.preventDefault();
      let error_validation = document.querySelector(".error_validation");
      let retirement_age = document.getElementById("retirement_age");
      let user_age = document.getElementById("user_age");
      let monthly_income = document.getElementById("monthly_income");
      let debts_and_expenses = document.getElementById("debts_and_expenses");
      let retirement_goal = document.getElementById("retirement_goal");

      error_validation.classList.add("error_active");

      if (!user_age.value) {
        user_age.focus();
        error_validation.innerHTML = "عمرك مطلوب.";
        return;
      }

      if (!retirement_age.value) {
        retirement_age.focus();
        error_validation.innerHTML = "عمر التقاعد مطلوب.";
        return;
      }

      if (!monthly_income.value) {
        monthly_income.focus();
        error_validation.innerHTML = "القسط الشهري مطلوب.";
        return;
      }

      if (!debts_and_expenses.value) {
        debts_and_expenses.focus();
        error_validation.innerHTML = "هدف التقاعد مطلوب.";
        return;
      }

      if (!retirement_goal.value) {
        retirement_goal.focus();
        error_validation.innerHTML = "هدف التقاعد مطلوب.";
        return;
      }

      let data = {
        retirement_age: retirement_age.value,
        user_age: user_age.value,
        debts_and_expenses: debts_and_expenses.value,
        monthly_income: monthly_income.value,
        retirement_goal: retirement_goal.value,
      };

      insertData("plan", data, "تم إنشاء خطة التقاعد!");
    });
}

let insert_debt_form = document.getElementById("insert_debt_form");
if (insert_debt_form) {
  insert_debt_form.addEventListener("keyup", () => {
    if (expenses.value != 0 && monthly_payment.value != 0) {
      duration.value = Math.ceil(expenses.value / monthly_payment.value);
    } else {
      duration.value = 0;
    }
  });

  insert_debt_form.addEventListener("submit", (e) => {
    e.preventDefault();

    let debt_goal = document.getElementById("debt_goal");
    let expenses = document.getElementById("expenses");
    let monthly_payment = document.getElementById("monthly_payment");
    let duration = document.getElementById("duration");
    let error_validation = document.querySelector(".error_validation");

    // التحقق من المدخلات
    if (!debt_goal.value) {
      debt_goal.focus();
      error_validation.innerHTML = "نوع الدين مطلوب.";
      error_validation.classList.add("error_active");
      return;
    }

    if (!expenses.value) {
      expenses.focus();
      error_validation.innerHTML = "كمية الدين مطلوبة.";
      error_validation.classList.add("error_active");
      return;
    }

    if (!monthly_payment.value) {
      monthly_payment.focus();
      error_validation.innerHTML = "القسط الشهري مطلوب.";
      error_validation.classList.add("error_active");
      return;
    }

    let data = {
      debt_goal: debt_goal.value,
      expenses: expenses.value,
      monthly_payment: monthly_payment.value,
      duration: duration.value,
    };

    // استدعاء دالة الإدخال
    insertData("debt", data, "تم إنشاء الدين!");
  });
}

let insert_budget_form = document.getElementById("insert_budget_form");
if (insert_budget_form) {
  insert_budget_form.addEventListener("submit", (e) => {
    e.preventDefault();
  });

  let error_validation = document.querySelector(".error_validation");
  let monthly_income1 = document.getElementById("monthly_income1");
  let monthly_income2 = document.getElementById("monthly_income2");
  let expensesInputs = document.querySelectorAll("input[name='expenses[]']");
  let expensesTotalInput = document.getElementById("expenses");
  let budget_goal = document.getElementById("budget_goal");
  let goal_date = document.getElementById("goal_date");
  let selling_goal = document.getElementById("selling_goal");
  let more_details = document.getElementById("more_details");
  let insert_budget = document.getElementById("insert_budget");
  // تخزين المصروفات في كائن
  let expensesObject = {};

  more_details.addEventListener("click", () => {
    // تصفية المدخلات للحصول على القيم غير الفارغة
    let expensesInputsFilter = Array.from(expensesInputs)
      .map((input) => ({
        key: input.dataset.key,
        value: parseFloat(input.value) || 0,
      }))
      .filter((item) => item.value > 0);

    if (expensesInputsFilter.length <= 0) {
      expensesInputs[1].focus();
      error_validation.classList.add("error_active");
      error_validation.innerHTML = "المصروفات مطلوب!";
      return;
    }

    // اجمع المصروفات
    expensesInputsFilter.forEach((item) => {
      expensesObject[item.key] = item.value;
    });

    // احسب إجمالي المصروفات
    let total_expenses = Object.values(expensesObject).reduce(
      (a, b) => a + b,
      0
    );
    expensesTotalInput.value = total_expenses;

    // إخفاء النسخة الأولى وإظهار النسخة الثانية
    document.querySelector(".version").style.display = "none";
    document.querySelector(".more_details").style.display = "block";
    error_validation.classList.remove("error_active");

    budget_goal.focus();
  });

  insert_budget_form.addEventListener("keyup", (e) => {
    if (
      monthly_income1.value &&
      expensesTotalInput.value &&
      expensesTotalInput.value != "" &&
      selling_goal.value &&
      selling_goal.value != ""
    ) {
      goal_date.value = Math.ceil(
        selling_goal.value / (monthly_income1.value - expensesTotalInput.value)
      );
    } else {
      goal_date.value = 0;
    }

    monthly_income2.value = monthly_income1.value;
    console.log(monthly_income2.value);
  });

  insert_budget.addEventListener("click", () => {
    if (monthly_income1.value == "") {
      monthly_income1.focus();
      error_validation.innerHTML = "الدخل الشهري مطلوب!";
      error_validation.classList.add("error_active");
      return;
    }

    if (budget_goal.value == "") {
      budget_goal.focus();
      error_validation.innerHTML = "الهدف مطلوب!";
      error_validation.classList.add("error_active");
      return;
    }

    if (selling_goal.value <= 0) {
      selling_goal.focus();
      error_validation.innerHTML = "مبلغ الهدف مطلوب!";
      error_validation.classList.add("error_active");
      return;
    }

    if (goal_date.value <= 0) {
      goal_date.focus();
      error_validation.innerHTML = "تاريخ انجاز الهدف مطلوب!";
      error_validation.classList.add("error_active");
      return;
    }

    let data = {
      monthly_income1: monthly_income1.value,
      expenses: JSON.stringify(expensesObject),
      total_expenses: expensesTotalInput.value,
      selling_goal: selling_goal.value,
      budget_goal: budget_goal.value,
      goal_date: goal_date.value,
    };

    document.querySelector(".error_validation").classList.add("success_active");
    document
      .querySelector(".error_validation")
      .classList.remove("error_active");
    document.querySelector(".error_validation").innerHTML =
      "تم إنشاء الميزانية";
    setTimeout(() => {
      document
        .querySelector(".error_validation")
        .classList.remove("success_active");
      location.href = "./services.php?page=budget_chart";
    }, 1000);

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

      if (
        !username.value ||
        !email.value ||
        !password.value ||
        !password_confirmation.value ||
        password.value != password_confirmation.value
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
      };

      location.href = "./";
      insertData("register", data, "تم إنشاء الحساب!");
    });
}

let signin_user = document.getElementById("signin_user");
if (signin_user) {
  signin_user.addEventListener("submit", function (e) {
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

    location.href = "./home.php";
    insertData("signin", data, "تم تسجيل الدخول!");
  });
}

function insertData(requestType, data, successMessage) {
  let xhr = new XMLHttpRequest();
  xhr.onreadystatechange = () => {
    if (xhr.readyState == 4) {
      if (xhr.status == 200) {
        let response = JSON.parse(xhr.responseText);
        console.log(response);
        if (response.status == "success") {
          document.querySelector(".error_validation").innerHTML =
            successMessage;
          Object.keys(data).forEach((key) => {
            document.getElementById(key).value = "";
          });
          document
            .querySelector(".error_validation")
            .classList.remove("error_active");
          document
            .querySelector(".error_validation")
            .classList.add("success_active");

          setTimeout(() => {
            document
              .querySelector(".error_validation")
              .classList.remove("success_active");
          }, 1000);

          setTimeout(() => {
            if (requestType == "plan") {
              location.href = "./services.php?page=plan_chart";
            }
            if (requestType == "debt") {
              location.href = "./services.php?page=debts_details";
            }
            if (requestType == "budget") {
              location.href = "./services.php?page=budgets_chart";
            }
          }, 1000);
        } else {
          document.querySelector(".error_validation").innerHTML =
            response.message;
        }
      } else {
        console.error("Error: " + xhr.status);
        document.querySelector(".error_validation").innerHTML =
          "في مشكله! جرب مره أخري.";
      }
    }
  };

  xhr.open(
    "POST",
    `./includes/database/ajax_server.php?request=${requestType}`,
    true
  );
  xhr.setRequestHeader("Content-Type", "application/json");
  xhr.send(JSON.stringify(data));
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
          }, 2000);
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
