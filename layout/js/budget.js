// التحقق من بيانات المستخدم في قاعدة البيانات
let budget_form = document.getElementById("budget_form");
if (budget_form) {
  budget_form.addEventListener("submit", (e) => {
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

  monthly_income1.style.border = "none";
  monthly_income2.style.border = "none";
  budget_goal.style.border = "none";
  goal_date.style.border = "none";
  selling_goal.style.border = "none";

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

    if (monthly_income1.value == "") {
      monthly_income1.focus();
      monthly_income1.style.border = "2px solid red";
      error_validation.innerHTML = "الدخل الشهري مطلوب!";
      error_validation.classList.add("error_active");
      return;
    }

    if (expensesInputsFilter.length <= 0) {
      expensesInputs[1].focus();
      expensesInputs[1].style.border = "2px solid red";
      error_validation.innerHTML = "المصروفات مطلوب!";
      error_validation.classList.add("error_active");
      return;
    }

    // اجمع المصروفات
    expensesInputsFilter.forEach((item) => {
      expensesObject[item.key] = item.value;
    });
    expensesObject["debts"] = 0;

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

    if (budget_form.dataset.action == "update") {
      goal_date.value = Math.ceil(
        selling_goal.value / (monthly_income1.value - expensesTotalInput.value)
      );
    }
  });

  budget_form.addEventListener("keyup", (e) => {
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
    if (budget_goal.value == "") {
      budget_goal.focus();
      budget_goal.style.border = "2px solid red";
      error_validation.innerHTML = "الهدف مطلوب!";
      error_validation.classList.add("error_active");
      return;
    }

    if (selling_goal.value <= 0) {
      selling_goal.focus();
      selling_goal.style.border = "2px solid red";
      error_validation.innerHTML = "مبلغ الهدف مطلوب!";
      error_validation.classList.add("error_active");
      return;
    }
    if (!goal_date.value || goal_date.value == 0) {
      goal_date.focus();
      goal_date.style.border = "2px solid red";
      error_validation.innerHTML = "تاريخ الانجاز الهدف مطلوب!";
      error_validation.classList.add("error_active");
      return;
    }

    if (goal_date.value <= 0) {
      goal_date.focus();
      goal_date.style.border = "2px solid red";
      error_validation.innerHTML = "تاريخ الانجاز غير صحيح!";
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
              location.href = "./services.php?page=budget_chart";
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

    let requestType = "";
    if (budget_form.dataset.action == "insert") {
      requestType = "insert";
    } else if (budget_form.dataset.action == "update") {
      requestType = "update";
    }

    xhr.open(
      "POST",
      `./includes/database/budget.php?request=${requestType}`,
      true
    );
    xhr.setRequestHeader("Content-Type", "application/json");
    xhr.send(JSON.stringify(data));
  });
}

// حذف الميزانية
let delete_budget = document.getElementById("delete_budget");
if (delete_budget) {
  delete_budget.addEventListener("click", (e) => {
    e.preventDefault();
    const result = confirm("هل أنت متأكد أنك تريد حذف الميزانية؟");

    if (result) {
      // كود ajax
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
                location.href = "./services.php?page=budget";
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

      xhr.open("POST", `./includes/database/budget.php?request=delete`, true);
      xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
      xhr.send("id=" + encodeURIComponent(delete_budget.dataset.id));
    }
  });
}
