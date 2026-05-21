<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login - <?= get_site_settings('site_name') ?? 'System879' ?></title>
    <style>
        body, html {
            margin: 0; padding: 0;
            width: 100%; height: 100%;
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Helvetica, Arial, sans-serif;
            background-color: #fbfbfd;
            display: flex;
            justify-content: center;
            align-items: center;
            color: #1d1d1f;
        }
        .login-container {
            width: 100%;
            max-width: 400px;
            padding: 40px;
            background: #ffffff;
            border-radius: 20px;
            box-shadow: 0 10px 40px rgba(0,0,0,0.05);
            box-sizing: border-box;
        }
        .brand {
            text-align: center;
            margin-bottom: 30px;
        }
        .brand h1 {
            font-size: 24px;
            font-weight: 600;
            margin: 0;
            letter-spacing: -0.02em;
        }
        .brand p {
            color: #86868b;
            font-size: 14px;
            margin-top: 5px;
        }
        .form-group {
            margin-bottom: 20px;
        }
        .form-label {
            display: block;
            margin-bottom: 8px;
            font-size: 14px;
            font-weight: 500;
            color: #1d1d1f;
        }
        .form-control {
            width: 100%;
            padding: 14px 16px;
            font-size: 16px;
            border: 1px solid #d2d2d7;
            border-radius: 12px;
            background-color: #fbfbfd;
            box-sizing: border-box;
            transition: border-color 0.2s ease;
        }
        .form-control:focus {
            outline: none;
            border-color: #0071e3;
            background-color: #ffffff;
        }
        .btn-submit {
            width: 100%;
            padding: 14px;
            background-color: #0071e3;
            color: #ffffff;
            border: none;
            border-radius: 12px;
            font-size: 16px;
            font-weight: 500;
            cursor: pointer;
            transition: background-color 0.2s ease;
        }
        .btn-submit:hover {
            background-color: #0077ed;
        }
        .alert {
            padding: 12px;
            border-radius: 10px;
            margin-bottom: 20px;
            font-size: 14px;
        }
        .alert-error {
            background-color: #fce8e6;
            color: #c5221f;
            border: 1px solid #f9d2ce;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <div class="brand">
            <h1>Admin Panel</h1>
            <p>Sign in to manage your content</p>
        </div>

        <?php if (session()->getFlashdata('error')): ?>
            <div class="alert alert-error">
                <?= session()->getFlashdata('error') ?>
            </div>
        <?php endif; ?>

        <?php if (session()->getFlashdata('errors')): ?>
            <div class="alert alert-error">
                <ul style="margin:0; padding-left:20px">
                    <?php foreach (session()->getFlashdata('errors') as $err): ?>
                        <li><?= $err ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        <?php endif; ?>

        <form action="<?= base_url('/admin/login') ?>" method="POST">
            <div class="form-group">
                <label class="form-label" for="username">Username</label>
                <input type="text" id="username" name="username" class="form-control" placeholder="Enter username" required autofocus value="<?= old('username') ?>">
            </div>
            <div class="form-group">
                <label class="form-label" for="password">Password</label>
                <input type="password" id="password" name="password" class="form-control" placeholder="Enter password" required>
            </div>
            <button type="submit" class="btn-submit">Sign In</button>
        </form>
    </div>
</body>
</html>
