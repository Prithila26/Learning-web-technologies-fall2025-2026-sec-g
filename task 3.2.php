<?php
$errors = array();
$success = false;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // 1. Full Name Validation
    $fullName = isset($_POST['fullName']) ? trim($_POST['fullName']) : '';
    
    // A. Cannot be empty
    if (empty($fullName)) {
        $errors['fullName'] = 'Full name cannot be empty';
    } else {
        // B. Contains at least two words
        if (str_word_count($fullName) < 2) {
            $errors['fullName'] = 'Full name must contain at least two words';
        }
        // C. Must start with a letter
        if (!ctype_alpha($fullName[0])) {
            $errors['fullName'] = 'Full name must start with a letter';
        }
        // D. Can contain a-z, A-Z, period, dash only
        if (!preg_match("/^[a-zA-Z.\-\s]+$/", $fullName)) {
            $errors['fullName'] = 'Full name can only contain letters, periods, dashes, and spaces';
        }
    }
    
    // 2. Email Validation
    $email = isset($_POST['email']) ? trim($_POST['email']) : '';
    
    // A. Cannot be empty
    if (empty($email)) {
        $errors['email'] = 'Email cannot be empty';
    } else {
        // B. Must be a valid email address
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors['email'] = 'Email must be in valid format (e.g., anything@example.com)';
        }
    }
    
    // 3. Date of Birth Validation
    $day = isset($_POST['day']) ? trim($_POST['day']) : '';
    $month = isset($_POST['month']) ? trim($_POST['month']) : '';
    $year = isset($_POST['year']) ? trim($_POST['year']) : '';
    
    // A. Cannot be empty
    if (empty($day) || empty($month) || empty($year)) {
        $errors['date'] = 'Date of birth cannot be empty';
    } else {
        // B. Must be valid numbers (dd: 1-31, mm: 1-12, yyyy: 1953-1998)
        if (!is_numeric($day) || !is_numeric($month) || !is_numeric($year)) {
            $errors['date'] = 'Date must contain valid numbers only';
        } elseif ($day < 1 || $day > 31 || $month < 1 || $month > 12 || $year < 1953 || $year > 1998) {
            $errors['date'] = 'Date must be valid: day (1-31), month (1-12), year (1953-1998)';
        }
    }
    
    // 4. Radio Button Validation (At least one must be selected)
    $radioChoice = isset($_POST['radioChoice']) ? $_POST['radioChoice'] : '';
    
    // A. At least one must be selected
    if (empty($radioChoice)) {
        $errors['radio'] = 'Please select at least one option';
    }
    
    // 5. Checkboxes Validation (At least two must be selected)
    $checkboxes = isset($_POST['checkboxes']) ? $_POST['checkboxes'] : array();
    
    // A. At least two must be selected
    if (count($checkboxes) < 2) {
        $errors['checkboxes'] = 'Please select at least two options';
    }
    
    // 6. Dropdown/Select Validation (Must be selected)
    $dropdown = isset($_POST['dropdown']) ? $_POST['dropdown'] : '';
    
    // A. Must be selected
    if (empty($dropdown)) {
        $errors['dropdown'] = 'Please select an option from the dropdown';
    }
    
    // If no errors, form is valid
    if (empty($errors)) {
        $success = true;
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>PHP Form Validation</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; background-color: #f4f4f4; }
        .container { background-color: white; padding: 20px; border-radius: 5px; max-width: 600px; }
        .form-group { margin-bottom: 20px; }
        label { display: block; margin-bottom: 5px; font-weight: bold; }
        input[type="text"], input[type="email"], select, textarea { width: 100%; padding: 8px; border: 1px solid #ccc; border-radius: 3px; }
        input[type="radio"], input[type="checkbox"] { margin-right: 10px; }
        .error { color: #d32f2f; font-size: 12px; margin-top: 5px; }
        .success { color: #388e3c; padding: 10px; background-color: #e8f5e9; border-radius: 3px; margin-bottom: 20px; }
        button { background-color: #2196f3; color: white; padding: 10px 20px; border: none; border-radius: 3px; cursor: pointer; }
        button:hover { background-color: #1976d2; }
        .date-inputs { display: flex; gap: 10px; }
        .date-inputs input { width: 60px; }
        .options-group { margin: 10px 0; }
    </style>
</head>
<body>
    <div class="container">
        <h1>PHP Form Validation</h1>
        
        <?php if ($success): ?>
            <div class="success">✓ Form submitted successfully! All validations passed.</div>
        <?php endif; ?>
        
        <form method="POST">
            <!-- 1. Full Name -->
            <div class="form-group">
                <label for="fullName">1. Full Name</label>
                <input type="text" id="fullName" name="fullName" value="<?php echo htmlspecialchars($_POST['fullName'] ?? ''); ?>">
                <?php if (isset($errors['fullName'])): ?>
                    <div class="error">✗ <?php echo $errors['fullName']; ?></div>
                <?php endif; ?>
            </div>
            
            <!-- 2. Email -->
            <div class="form-group">
                <label for="email">2. Email Address</label>
                <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($_POST['email'] ?? ''); ?>">
                <?php if (isset($errors['email'])): ?>
                    <div class="error">✗ <?php echo $errors['email']; ?></div>
                <?php endif; ?>
            </div>
            
            <!-- 3. Date of Birth -->
            <div class="form-group">
                <label>3. Date of Birth (dd/mm/yyyy)</label>
                <div class="date-inputs">
                    <input type="text" name="day" placeholder="Day (1-31)" value="<?php echo htmlspecialchars($_POST['day'] ?? ''); ?>">
                    <input type="text" name="month" placeholder="Month (1-12)" value="<?php echo htmlspecialchars($_POST['month'] ?? ''); ?>">
                    <input type="text" name="year" placeholder="Year (1953-1998)" value="<?php echo htmlspecialchars($_POST['year'] ?? ''); ?>">
                </div>
                <?php if (isset($errors['date'])): ?>
                    <div class="error">✗ <?php echo $errors['date']; ?></div>
                <?php endif; ?>
            </div>
            
            <!-- 4. Radio Buttons (At least one) -->
            <div class="form-group">
                <label>4. Select One Option</label>
                <div class="options-group">
                    <input type="radio" id="radio1" name="radioChoice" value="Option1" <?php echo (isset($_POST['radioChoice']) && $_POST['radioChoice'] == 'Option1') ? 'checked' : ''; ?>>
                    <label for="radio1" style="display: inline; font-weight: normal;">Option 1</label>
                </div>
                <div class="options-group">
                    <input type="radio" id="radio2" name="radioChoice" value="Option2" <?php echo (isset($_POST['radioChoice']) && $_POST['radioChoice'] == 'Option2') ? 'checked' : ''; ?>>
                    <label for="radio2" style="display: inline; font-weight: normal;">Option 2</label>
                </div>
                <div class="options-group">
                    <input type="radio" id="radio3" name="radioChoice" value="Option3" <?php echo (isset($_POST['radioChoice']) && $_POST['radioChoice'] == 'Option3') ? 'checked' : ''; ?>>
                    <label for="radio3" style="display: inline; font-weight: normal;">Option 3</label>
                </div>
                <?php if (isset($errors['radio'])): ?>
                    <div class="error">✗ <?php echo $errors['radio']; ?></div>
                <?php endif; ?>
            </div>
            
            <!-- 5. Checkboxes (At least two) -->
            <div class="form-group">
                <label>5. Select at Least Two</label>
                <div class="options-group">
                    <input type="checkbox" id="check1" name="checkboxes[]" value="Check1" <?php echo (isset($_POST['checkboxes']) && in_array('Check1', $_POST['checkboxes'])) ? 'checked' : ''; ?>>
                    <label for="check1" style="display: inline; font-weight: normal;">Checkbox 1</label>
                </div>
                <div class="options-group">
                    <input type="checkbox" id="check2" name="checkboxes[]" value="Check2" <?php echo (isset($_POST['checkboxes']) && in_array('Check2', $_POST['checkboxes'])) ? 'checked' : ''; ?>>
                    <label for="check2" style="display: inline; font-weight: normal;">Checkbox 2</label>
                </div>
                <div class="options-group">
                    <input type="checkbox" id="check3" name="checkboxes[]" value="Check3" <?php echo (isset($_POST['checkboxes']) && in_array('Check3', $_POST['checkboxes'])) ? 'checked' : ''; ?>>
                    <label for="check3" style="display: inline; font-weight: normal;">Checkbox 3</label>
                </div>
                <div class="options-group">
                    <input type="checkbox" id="check4" name="checkboxes[]" value="Check4" <?php echo (isset($_POST['checkboxes']) && in_array('Check4', $_POST['checkboxes'])) ? 'checked' : ''; ?>>
                    <label for="check4" style="display: inline; font-weight: normal;">Checkbox 4</label>
                </div>
                <?php if (isset($errors['checkboxes'])): ?>
                    <div class="error">✗ <?php echo $errors['checkboxes']; ?></div>
                <?php endif; ?>
            </div>
            
            <!-- 6. Dropdown/Select -->
            <div class="form-group">
                <label for="dropdown">6. Select an Option</label>
                <select id="dropdown" name="dropdown">
                    <option value="">-- Please Select --</option>
                    <option value="Select1" <?php echo (isset($_POST['dropdown']) && $_POST['dropdown'] == 'Select1') ? 'selected' : ''; ?>>Selection 1</option>
                    <option value="Select2" <?php echo (isset($_POST['dropdown']) && $_POST['dropdown'] == 'Select2') ? 'selected' : ''; ?>>Selection 2</option>
                    <option value="Select3" <?php echo (isset($_POST['dropdown']) && $_POST['dropdown'] == 'Select3') ? 'selected' : ''; ?>>Selection 3</option>
                </select>
                <?php if (isset($errors['dropdown'])): ?>
                    <div class="error">✗ <?php echo $errors['dropdown']; ?></div>
                <?php endif; ?>
            </div>
            
            <button type="submit">Validate and Submit</button>
        </form>
    </div>
</body>
</html>