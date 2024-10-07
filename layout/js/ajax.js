let insert_plan_form = document.getElementById("insert_plan_form");
if (insert_plan_form) {
  insert_plan_form.addEventListener("submit", function (e) {
    e.preventDefault();
    let error_validation = document.querySelector(".error_validation");
    let retirement_age = document.getElementById("retirement_age");
    let user_age = document.getElementById("user_age");
    let monthly_income = document.getElementById("monthly_income");
    let debts_and_expenses = document.getElementById("debts_and_expenses");
    let retirement_goal = document.getElementById("retirement_goal");

    retirement_age.style.border = "none";
    user_age.style.border = "none";
    monthly_income.style.border = "none";
    debts_and_expenses.style.border = "none";
    retirement_goal.style.border = "none";

    error_validation.classList.add("error_active");

    if (!user_age.value) {
      user_age.focus();
      user_age.style.border = "2px solid red";
      error_validation.innerHTML = "عمرك مطلوب.";
      return;
    }

    if (!retirement_age.value) {
      retirement_age.focus();
      retirement_age.style.border = "2px solid red";
      error_validation.innerHTML = "عمر التقاعد مطلوب.";
      return;
    }

    if (!monthly_income.value) {
      monthly_income.focus();
      monthly_income.style.border = "2px solid red";
      error_validation.innerHTML = "القسط الشهري مطلوب.";
      return;
    }

    if (!debts_and_expenses.value) {
      debts_and_expenses.focus();
      debts_and_expenses.style.border = "2px solid red";
      error_validation.innerHTML = "هدف التقاعد مطلوب.";
      return;
    }

    if (!retirement_goal.value) {
      retirement_goal.focus();
      retirement_goal.style.border = "2px solid red";
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

    if (insert_plan_form.dataset.action == "insert") {
      insertData("plan_insert", data, "تم إنشاء خطة التقاعد!");
    } else if (insert_plan_form.dataset.action == "update") {
      insertData("plan_update", data, "تم تحديث خطة التقاعد!");
    }
  });
}

let trash_plan = document.getElementById("trash_plan");
if (trash_plan) {
  trash_plan.addEventListener("click", (e) => {
    e.preventDefault();
    const result = confirm("هل أنت متأكد أنك تريد حذف خطة التقاعد؟");

    if (result) {
      deleteData("trash_plan", trash_plan.dataset.id);
    }
  });
}

let insert_budget_form = document.getElementById("insert_budget_form");
if (insert_budget_form) {
  insert_budget_form.addEventListener("submit", (e) => {
    e.preventDefault();
  });

  let monthly_income1 = document.getElementById("monthly_income1");
  let monthly_income2 = document.getElementById("monthly_income2");
  let expensesInputs = document.querySelectorAll("input[name='expenses[]']");
  let expensesTotalInput = document.getElementById("expenses");
  let budget_goal = document.getElementById("budget_goal");
  let goal_date = document.getElementById("goal_date");
  let selling_goal = document.getElementById("selling_goal");
  let more_details = document.getElementById("more_details");
  let insert_budget = document.getElementById("insert_budget");
  let error_validation = document.querySelector(".error_validation");

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
      error_validation.innerHTML = "المصروفات مطلوب!";
      error_validation.classList.add("error_active");
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

    if (insert_budget_form.dataset.action == "update") {
      goal_date.value = Math.ceil(
        selling_goal.value / (monthly_income1.value - expensesTotalInput.value)
      );
    }
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

    if (insert_budget_form.dataset.action == "insert") {
      insertData("budget_insert", data, "تم إنشاء الميزانية!");
    } else if (insert_budget_form.dataset.action == "update") {
      insertData("budget_update", data, "تم تحديث الميزانية!");
    }
  });
}

let trash_budget = document.getElementById("trash_budget");
if (trash_budget) {
  trash_budget.addEventListener("click", (e) => {
    e.preventDefault();
    const result = confirm("هل أنت متأكد أنك تريد حذف الميزانية؟");

    if (result) {
      deleteData("trash_budget", trash_budget.dataset.id);
    }
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

      username.style.border =
        "2px solid var(--mainColor) ;solid var(--mainColor)";
      email.style.border = "2px solid var(--mainColor) ;solid var(--mainColor)";
      password.style.border =
        "2px solid var(--mainColor) ;solid var(--mainColor)";
      password_confirmation.style.border =
        "2px solid var(--mainColor) ;solid var(--mainColor)";

      // التحقق من القيم المدخلة
      if (!username.value) {
        username.focus();
        username.style.border = "2px solid var(--mainColor) ;solid red";
        error_validation.innerHTML = "اسم المستخدم مطلوب.";
        return;
      }

      if (!email.value) {
        email.focus();
        email.style.border = "2px solid var(--mainColor) ;solid red";
        error_validation.innerHTML = "البريد الإلكتروني مطلوب.";
        return;
      }

      if (!password.value) {
        password.focus();
        password.style.border = "2px solid var(--mainColor) ;solid red";
        error_validation.innerHTML = "كلمة المرور مطلوبة.";
        return;
      }

      if (password.value.length < 7) {
        password.focus();
        password.style.border = "2px solid var(--mainColor) ;solid red";
        error_validation.innerHTML =
          "كلمة المرور يجب ان تكون اكبر من 7 حروف او ارقام.";
        return;
      }

      if (!password_confirmation.value) {
        password_confirmation.focus();
        password_confirmation.style.border =
          "2px solid var(--mainColor) ;solid red";
        error_validation.innerHTML = "تأكيد كلمة المرور مطلوب.";
        return;
      }

      // التحقق من تطابق كلمة المرور مع التأكيد
      if (password.value !== password_confirmation.value) {
        password_confirmation.focus();
        password.style.border = "2px solid var(--mainColor) ;solid red";
        password_confirmation.style.border =
          "2px solid var(--mainColor) ;solid red";
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

    insertData("signin", data, "تم تسجيل الدخول!");
  });
}

function insertData(requestType, data, successMessage) {
  let xhr = new XMLHttpRequest();
  xhr.onreadystatechange = () => {
    if (xhr.readyState == 4) {
      if (xhr.status == 200) {
        let response = JSON.parse(xhr.responseText);
        let error_validation = document.querySelector(".error_validation");

        if (response.status == "success") {
          error_validation.innerHTML = successMessage;
          error_validation.classList.remove("error_active");
          error_validation.classList.add("success_active");

          setTimeout(() => {
            error_validation.classList.remove("success_active");
          }, 1000);

          setTimeout(() => {
            if (requestType == "plan_insert" || requestType == "plan_update") {
              location.href = "./services.php?page=plan_chart";
            } else if (
              requestType == "budget_insert" ||
              requestType == "budget_update"
            ) {
              location.href = "./services.php?page=budget_chart";
            } else if (requestType == "debt") {
              location.href = "./services.php?page=debts_details";
            } else if (requestType == "register") {
              location.href = "./";
            } else if (requestType == "signin") {
              location.href = "./home.php";
            }
          }, 1000);
        } else {
          error_validation.innerHTML = response.message;
          error_validation.classList.add("error_active");
          error_validation.classList.remove("success_active");
          setTimeout(() => {
            error_validation.classList.remove("success_active");
          }, 1000);
        }
      } else {
        console.error("Error: " + xhr.status);
        error_validation.innerHTML = "في مشكله! جرب مره أخري.";
        error_validation.classList.add("error_active");
        error_validation.classList.remove("success_active");
        setTimeout(() => {
          error_validation.classList.remove("success_active");
        }, 1000);
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

function deleteData(requestType, id) {
  let xhr = new XMLHttpRequest();
  xhr.onreadystatechange = () => {
    if (xhr.readyState == 4) {
      let error_validation = document.querySelector(".error_validation");
      if (xhr.status == 200) {
        let response = JSON.parse(xhr.responseText);
        if (response.status == "success") {
          error_validation.innerHTML = response.message;
          error_validation.classList.add("success_active");
          error_validation.classList.remove("error_active");

          setTimeout(() => {
            error_validation.classList.remove("success_active");
            if (requestType == "trash_plan") {
              location.href = "./services.php?page=plan";
            }
            if (requestType == "trash_budget") {
              location.href = "./services.php?page=budget";
            }
          }, 1000);
        } else {
          error_validation.innerHTML = response.message;
        }
      } else {
        console.error("Error: " + xhr.status);
        error_validation.innerHTML = "في مشكلة! جرب مرة أخرى.";
        error_validation.classList.add("error_active");
        error_validation.classList.remove("success_active");
      }
    }
  };

  xhr.open(
    "POST",
    `./includes/database/ajax_server.php?request=${requestType}`,
    true
  );
  xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
  xhr.send("id=" + encodeURIComponent(id));
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
    const result = confirm("هل أنت متأكد أنك تريد هذا الدين");
    if (result) {
      updatedData("trash", minus.dataset.debt_id);
    }
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
    const result = confirm("هل دفعت هذا القسط؟");
    if (result) {
      debt.classList.add("fa-check");
      debt.parentElement.parentElement.classList.add("disabled");
      setTimeout(() => {
        debt.classList.remove("fa-circle");
        updatedData("check", debt.dataset.debt_id);
      }, 500);
    }
  });
});

function updatedData(requestType, id) {
  let xhr = new XMLHttpRequest();
  xhr.onreadystatechange = () => {
    if (xhr.readyState == 4) {
      let customAlert = document.querySelector(".customAlert");
      if (xhr.status == 200) {
        let response = JSON.parse(xhr.responseText);
        if (response.status == "success") {
          customAlert.innerHTML = response.message;
          customAlert.classList.add("success");

          if (requestType == "check") {
            document.querySelector(
              `.expenses_${id}`
            ).innerHTML = `${response.data.expenses} ر.س`;
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
