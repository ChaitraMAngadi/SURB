<!DOCTYPE html>
<html>
<head>
    <title>Feature Status</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .container {
            margin: auto;
            width: 50%;
            padding: 10px;
            box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
            border-radius: 5px;
            background-color: #fff;
            display: flex;
            flex-direction: column;
            align-items: center;
        }
        h2 {
            font-weight: bold;
            font-size: 24px;
            width: 100%;
            text-align: center;
        }
        form {
            width: 100%;
        }
        .checkbox {
            margin-bottom: 20px;
        }
        label {
            font-size: 18px;
        }
        button {
            width: 100%;
            background-color: #007bff;
            color: white;
            padding: 10px 0;
            font-size: 16px;
            border-radius: 5px;
            border: none;
            cursor: pointer;
        }
        button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>

<div class="container">
    <h2>Feature Status</h2>

    <form action="<?php echo site_url('admin/feature/update'); ?>" method="post">
        <?php foreach ($features as $feature): ?>
            <div class="checkbox">
                <label>
                    <input type="checkbox" name="feature_<?php echo $feature->id; ?>" value="1" <?php echo ($feature->status == 1) ? 'checked' : ''; ?>>
                    <?php echo $feature->name; ?>
                </label>
            </div>
        <?php endforeach; ?>
        <button type="submit">Update Status</button>
    </form>
</div>

</body>
</html>


