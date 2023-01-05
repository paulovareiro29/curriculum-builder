<!DOCTYPE html>
<html lang="en">

<head>
    <?php require_once(__ROOT__ . "/layout/head.php"); ?>

    <link rel="stylesheet" href="/<?= $_ENV['SRC_DIR'] ?>/assets/css/salary.css" />
    <title>Curriculum Builder</title>
</head>

<?php require_once(__ROOT__ . "/layout/body.php") ?>
<?php require_once(__ROOT__ . "/layout/navbar.php") ?>

<div class="modal guide-modal" id="salary-calculator">
    <div class="modal-background"></div>
    <div class="modal-wrapper">
        <h4 class="modal-title">
            How does it work?
            <i class="fa-solid fa-xmark modal-close"></i>
        </h4>
        <div class="modal-body">
            <div>
            </div>
            <button type="button" class="btn btn-md" onclick="closeModal('salary-calculator')">GOT IT</button>
        </div>
    </div>
</div>

<div class="container">
    <div>
        <div class="d-flex align-center gap-8 mb-16">
            <h1>Salary Calculator</h1>
            <button type="button" onclick="showModal('salary-calculator')" class="btn btn-circle-md guide-btn">?</button>
        </div>
    </div>

    <form action="#" class="salary-calculator-form mb-16">
        <div class="form-row">
            <div>
                <h2>Earnings</h2>
                <div class="form-row mb-16">
                    <div class="form-group">
                        <label for="gross">Gross income</label>
                        <input type="number" name="gross" id="gross" min="0" placeholder="Gross Income" required />
                    </div>
                </div>
            </div>
        </div>

        <div class="form-row">
            <div>
                <h2>Meal Allowance</h2>
                <div class="form-row">
                    <div class="form-group">
                        <label for="meal-type">Meal Type</label>
                        <select name="meal-type" id="meal-type">
                            <option value="none">None</option>
                            <option value="card">Meal Card</option>
                            <option value="money">Money</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="meal-daily">Daily value</label>
                        <input type="number" name="meal-daily" value="7.63" id="meal-daily" min="0" placeholder="Daily value" required />
                    </div>
                    <div class="form-group">
                        <label for="meal-days">Days</label>
                        <input type="number" name="meal-days" id="meal-days" min="1" max="31" value="22" placeholder="Days" required />
                    </div>
                </div>
            </div>
        </div>
    </form>

    <div class="salary-calculator-results">
        <div class="results">
            <h2>Results</h2>

            <div>
                <p>IRS Tax</p>
                <p id="irs-tax">0.00€</p>
            </div>
            <div>
                <p>Social Security Tax</p>
                <p id="ss-tax">0.00€</p>
            </div>
            <div class="bg-success">
                <p>Liquid Salary</p>
                <p id="liquid-salary">0.00€</p>
            </div>
        </div>
    </div>
</div>

<script src="/<?= $_ENV['SRC_DIR'] ?>/assets/js/salary.js"></script>
<?php require_once(__ROOT__ . "/layout/footer.php") ?>