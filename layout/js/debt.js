// التحقق من بيانات المستخدم في قاعدة البيانات
let debt_form = document.getElementById("debt_form");
if (debt_form) {
  debt_form.addEventListener("keyup", () => {
    if (expenses.value != 0 && monthly_payment.value != 0) {
      duration.value = Math.ceil(expenses.value / monthly_payment.value);
    } else {
      duration.value = 0;
    }
  });

  debt_form.addEventListener("submit", (e) => {
    e.preventDefault();

    let error_validation = document.querySelector(".error_validation");
    let debt_goal = document.getElementById("debt_goal");
    let expenses = document.getElementById("expenses");
    let monthly_payment = document.getElementById("monthly_payment");
    let duration = document.getElementById("duration");

    debt_goal.style.border = "none";
    expenses.style.border = "none";
    monthly_payment.style.border = "none";

    // التحقق من المدخلات
    if (!debt_goal.value) {
      debt_goal.focus();
      debt_goal.style.border = "2px solid red";
      error_validation.innerHTML = "نوع الدين مطلوب.";
      error_validation.classList.add("error_active");
      return;
    }

    if (!expenses.value) {
      expenses.focus();
      expenses.style.border = "2px solid red";
      error_validation.innerHTML = "كمية الدين مطلوبة.";
      error_validation.classList.add("error_active");
      return;
    }

    if (!monthly_payment.value) {
      monthly_payment.focus();
      monthly_payment.style.border = "2px solid red";
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

    // كود ajax
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
              location.href = "./services.php?page=debts_details";
            }, 1000);
          } else {
            error_validation.innerHTML = response.message;
            error_validation.classList.add("error_active");
            error_validation.classList.remove("success_active");
            setTimeout(() => {
              error_validation.classList.remove("error_active");
            }, 1000);
          }
        } else {
          console.error("Error: " + xhr.status);
          error_validation.innerHTML = "في مشكله! جرب مره أخري.";
          error_validation.classList.add("error_active");
          error_validation.classList.remove("success_active");

          setTimeout(() => {
            error_validation.classList.remove("error_active");
          }, 1000);
        }
      }
    };

    xhr.open("POST", `./includes/database/debt.php?request=insert`, true);
    xhr.setRequestHeader("Content-Type", "application/json");
    xhr.send(JSON.stringify(data));
  });
}

// فتح قائمة الاقساط
let fa_chevron_downs = document.querySelectorAll(".tbody .fa-chevron-down");
fa_chevron_downs.forEach((chevron) => {
  chevron.addEventListener("click", () => {
    let payment = chevron.closest(".row").nextElementSibling;
    chevron.classList.toggle("fa-rotate-180");
    if (payment) payment.classList.toggle("show");
  });
});

// سداد القسط
let update_debts = document.querySelectorAll(".update_debt");
update_debts.forEach((debt) => {
  debt.addEventListener("click", () => {
    let error_validation = document.querySelector(".error_validation");

    const result = confirm("هل دفعت هذا القسط؟");
    if (result == true) {
      debt.classList.add("fa-check");
      debt.classList.remove("fa-circle");
      debt.parentElement.parentElement.classList.add("disabled");

      // كود ajax
      let xhr = new XMLHttpRequest();
      xhr.onreadystatechange = () => {
        if (xhr.readyState == 4) {
          if (xhr.status == 200) {
            let response = JSON.parse(xhr.responseText);
            console.log(response);
            if (response.status == "success") {
              error_validation.innerHTML = response.message;

              error_validation.classList.add("success_active");
              error_validation.classList.remove("error_active");

              document.querySelector(
                `.expenses_${debt.dataset.debt_id}`
              ).innerHTML = `${response.data.expenses} ر.س`;

              setTimeout(() => {
                error_validation.classList.remove("success_active");
              }, 2000);
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

      xhr.open("POST", `./includes/database/debt.php?request=check`, true);
      xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
      xhr.send("id=" + encodeURIComponent(debt.dataset.debt_id));
    }
  });
});

// حذف الدين
let fa_minuses = document.querySelectorAll(".tbody .fa-minus");
fa_minuses.forEach((debt) => {
  debt.addEventListener("click", () => {
    let error_validation = document.querySelector(".error_validation");
    const result = confirm("هل أنت متأكد أنك تريد حذف هذا الدين");
    if (result) {
      // كود ajax
      let xhr = new XMLHttpRequest();
      xhr.onreadystatechange = () => {
        if (xhr.readyState == 4) {
          if (xhr.status == 200) {
            let response = JSON.parse(xhr.responseText);
            if (response.status == "success") {
              error_validation.innerHTML = response.message;

              error_validation.classList.add("success_active");
              error_validation.classList.remove("error_active");

              document.getElementById(`debt_${debt.dataset.debt_id}`).remove();

              setTimeout(() => {
                error_validation.classList.remove("success_active");
              }, 2000);
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

      xhr.open("POST", `./includes/database/debt.php?request=delete`, true);
      xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
      xhr.send("id=" + encodeURIComponent(debt.dataset.debt_id));
    }
  });
});
