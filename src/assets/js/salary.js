const grossInput = document.getElementById("gross");
const mealTypeInput = document.getElementById("meal-type");
const mealDailyInput = document.getElementById("meal-daily");
const mealDaysInput = document.getElementById("meal-days");

const irsResult = document.getElementById("irs-tax");
const ssResult = document.getElementById("ss-tax");
const salaryResult = document.getElementById("liquid-salary");

const IRS = [
  { value: 710, tax: 0 },
  { value: 1015, tax: 0.113 },
  { value: 1577, tax: 0.172 },
  { value: 2109, tax: 0.219 },
  { value: 5241, tax: 0.323 },
  { value: 11384, tax: 0.392 },
  { value: 25504, tax: 0.438 },
];

const mealDailyLimit = {
  money: 4.77,
  card: 7.63,
};

const calculateSalary = () => {
  const mealType = mealTypeInput.value || "money";
  const mealDays = minMax(toSafeInt(mealDaysInput.value, 0), 1, 31);
  let gross = toSafeFloat(grossInput.value, 0);
  let mealDaily =
    mealType !== "none" ? Math.max(toSafeFloat(mealDailyInput.value, 0), 0) : 0;

  let limit = mealDailyLimit[mealType] || 0;

  if (mealDaily > limit) {
    gross += mealDaily - limit;
    mealDaily = limit;
  }

  const ssTax = gross * 0.11;
  let irsTax = gross * IRS[0].tax;

  for (let i = 0; i < IRS.length - 1; i++) {
    if (gross > IRS[i].value) irsTax = gross * IRS[i + 1].tax;
  }

  const total = gross + mealDaily * mealDays - ssTax - irsTax;

  irsResult.innerHTML = irsTax.toFixed(2) + "€";
  ssResult.innerHTML = ssTax.toFixed(2) + "€";
  salaryResult.innerHTML = total.toFixed(2) + "€";
};

grossInput.addEventListener("input", calculateSalary);
mealTypeInput.addEventListener("input", calculateSalary);
mealDailyInput.addEventListener("input", calculateSalary);
mealDaysInput.addEventListener("input", calculateSalary);
