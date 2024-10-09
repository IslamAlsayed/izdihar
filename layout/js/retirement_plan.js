// التحقق من بيانات المستخدم في قاعدة البيانات
let retirement_plan_form = document.getElementById("retirement_plan_form");
if (retirement_plan_form) {
  retirement_plan_form.addEventListener("submit", function (e) {
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
      error_validation.innerHTML = "الديون والمصروفات مطلوب.";
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
              location.href = "./services.php?page=plan_chart";
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
    if (retirement_plan_form.dataset.action == "insert") {
      requestType = "insert";
    } else if (retirement_plan_form.dataset.action == "update") {
      requestType = "update";
    }

    xhr.open(
      "POST",
      `./includes/database/retirement_plan.php?request=${requestType}`,
      true
    );
    xhr.setRequestHeader("Content-Type", "application/json");
    xhr.send(JSON.stringify(data));
  });
}

// حذف خطة التقاعد
let delete_plan = document.getElementById("delete_plan");
if (delete_plan) {
  delete_plan.addEventListener("click", (e) => {
    e.preventDefault();
    const result = confirm("هل أنت متأكد أنك تريد حذف خطة التقاعد؟");

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
                location.href = "./services.php?page=plan";
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
        `./includes/database/retirement_plan.php?request=delete`,
        true
      );
      xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
      xhr.send("id=" + encodeURIComponent(delete_plan.dataset.id));
    }
  });
}
