<?php

$i18n = [
    // Registration page
    "create_account" => "You need to create an account before you're able to login",
    "username" => "Username",
    "password" => "Password",
    "email" => "Email",
    "confirm_password" => "Confirm Password",
    "main_currency" => "Main Currency",
    "language" => "Language",
    "passwords_dont_match" => "Passwords do not match",
    "username_exists" => "Username already exists",
    "email_exists" => "Email already exists",
    "registration_failed" => "Registration failed, please try again.",
    "register" => "Register",
    "restore_database" => "Restore Database",
    // Login Page
    "please_login" => "Please login",
    "stay_logged_in" => "Stay logged in (30 days)",
    "login" => "Login",
    "login_failed" => "Login details are incorrect",
    "registration_successful" => "Registration successful",
    "user_email_waiting_verification" => "Your email needs to be verified. Please check your email.",
    // Password Reset Page
    "forgot_password" => "Forgot Password",
    "reset_password" => "Reset Password",
    "reset_sent_check_email" => "Reset email sent. Please check your email.",
    "password_reset_successful" => "Password reset successful",
    // Header
    "profile" => "Profile",
    "subscriptions" => "Subscriptions",
    "stats" => "Statistics",
    "settings" => "Settings",
    "admin" => "Admin",
    "about" => "About",
    "logout" => "Logout",
    // Subscriptions page
    "subscription" => "Subscription",
    "no_subscriptions_yet" => "You don't have any subscriptions yet",
    "add_first_subscription" => "Add first subscription",
    "new_subscription" => "New Subscription",
    "search" => "Search",
    "state" => "State",
    "alphanumeric" => "Alphanumeric",
    "sort" => "Sort",
    "name" => "Name",
    "last_added" => "Last Added",
    "price" => "Price",
    "next_payment" => "Next Payment",
    "auto_renewal" => "Auto Renewal",
    "automatically_renews" => "Automatically renews",
    "manual_renewal" => "Manual Renewal",
    "start_date" => "Start Date",
    "inactive" => "Disable Subscription",
    "replaced_with" => "Replaced with",
    "none" => "None",
    "member" => "Member",
    "category" => "Category",
    "payment_method" => "Payment Method",
    "Daily" => "Daily",
    "Weekly" => "Weekly",
    "Monthly" => "Monthly",
    "Yearly" => "Yearly",
    "daily" => "Day(s)",
    "weekly" => "Week(s)",
    "monthly" => "Month(s)",
    "yearly" => "Year(s)",
    "days" => "days",
    "weeks" => "weeks",
    "months" => "months",
    "years" => "years",
    "external_url" => "Visit External URL",
    "empty_page" => "Empty Page",
    "clear_filters" => "Clear Filters",
    "no_matching_subscriptions" => "No matching subscriptions",
    "clone" => "Clone",
    "renew" => "Renew",
    // Subscription form
    "add_subscription" => "Add subscription",
    "edit_subscription" => "Edit subscription",
    "subscription_name" => "Subscription name",
    "logo_preview" => "Logo Preview",
    "search_logo" => "Search logo on the web",
    "web_search" => "Web search",
    "currency" => "Currency",
    "payment_every" => "Payment every",
    "frequency" => "Frequency",
    "cycle" => "Cycle",
    "no_category" => "No category",
    "paid_by" => "Paid by",
    "url" => "URL",
    "notes" => "Notes",
    "enable_notifications" => "Enable Notifications for this subscription",
    "default_value_from_settings" => "Default value from settings",
    "cancellation_notification" => "Cancellation Notification",
    "delete" => "Delete",
    "cancel" => "Cancel",
    "upload_logo" => "Upload Logo",
    // Statistics page
    "cant_convert_currency" => "You are using multiple currencies on your subscriptions. To have valid and accurate statistics, please set a Fixer API Key on the settings page.",
    "general_statistics" => "General Statistics",
    "active_subscriptions" => "Active Subscriptions",
    "inactive_subscriptions" => "Inactive Subscriptions",
    "monthly_cost" => "Monthly Cost",
    "yearly_cost" => "Yearly Cost",
    "average_monthly" => "Average Monthly Subscription Cost",
    "most_expensive" => "Most Expensive Subscription Cost",
    "amount_due" => "Amount due this month",
    "percentage_budget_used" => "Percentage of budget used",
    "budget_remaining" => "Budget Remaining",
    "amount_over_budget" => "Amount over budget",
    "monthly_savings" => "Monthly Savings (on inactive subscriptions)",
    "yearly_savings" => "Yearly Savings (on inactive subscriptions)",
    "split_views" => "Split Views",
    "category_split" => "Category Split",
    "household_split" => "Household Split",
    "payment_method_split" => "Payment Method Split",
    "total_cost_trend" => "Total Cost Trend",
    // About page
    "about_and_credits" => "About and Credits",
    "credits" => "Credits",
    "license" => "License",
    "issues_and_requests" => "Issues and Requests",
    "the_author" => "The author",
    "icons" => "Icons",
    "payment_icons" => "Payment Icons",
    // Profile page
    "upload_avatar" => "Upload Avatar",
    "file_type_error" => "The file type supplied is not supported.",
    "user_details" => "User Details",
    "two_factor_authentication" => "Two Factor Authentication",
    "two_factor_info" => "Two Factor Authentication adds an extra layer of security to your account.<br>You will need an authenticator app like Google Authenticator, Authy or Ente Auth to scan the QR code.",
    "two_factor_enabled_info" => "Your account is secure with Two Factor Authentication. You can disable it by clicking the button above.",
    "enable_two_factor_authentication" => "Enable Two Factor Authentication",
    "2fa_already_enabled" => "Two Factor Authentication is already enabled",
    "totp_code_incorrect" => "TOTP code is incorrect",
    "backup_codes" => "Backup Codes",
    "download_backup_codes" => "Download Backup Codes",
    "copy_to_clipboard" => "Copy to clipboard",
    "totp_backup_codes_info" => "These codes can be used to login if you lose access to your authenticator app.",
    "disable_two_factor_authentication" => "Disable Two Factor Authentication",
    "totp_code" => "TOTP Code",
    "api_key" => "API Key",
    "regenerate" => "Regenerate",
    "api_key_info" => "The API key is used to access the API. Keep it secret.",
    // Settings page
    "monthly_budget" => "Monthly Budget",
    "budget_info" => "Monthly budget is used to calculate statistics",
    "household" => "Household",
    "save_member" => "Save Member",
    "delete_member" => "Delete Member",
    "cant_delete_member" => "Can't delete main member",
    "cant_delete_member_in_use" => "Can't delete member in use in subscription",
    "household_info" => "Email field allows for household members to be notified of subscriptions about to expire.",
    "notifications" => "Notifications",
    "enable_email_notifications" => "Enable email notifications",
    "notify_me" => "Notify me",
    "day_before" => "day before",
    "days_before" => "days before",
    "smtp_address" => "SMTP Address",
    "port" => "Port",
    "tls" => "TLS",
    "ssl" => "SSL",
    "smtp_username" => "SMTP Username",
    "smtp_password" => "SMTP Password",
    "from_email" => "From email (Optional)",
    "send_to_other_emails" => "Also send notifications to the following email addresses (use ; to separate them):",
    "other_emails_placeholder" => "user@domain.com;test@user.com",
    "smtp_info" => "SMTP Password is transmitted and stored in plaintext. For security, please create an account just for this.",
    "telegram" => "Telegram",
    "telegram_bot_token" => "Telegram Bot Token",
    "telegram_chat_id" => "Telegram Chat ID",
    "webhook" => "Webhook",
    "webhook_url" => "Webhook URL",
    "request_method" => "Request Method",
    "custom_headers" => "Custom Headers",
    "webhook_payload" => "Webhook Payload",
    "webhook_iterator_key" => "Replace {{subscriptions}} with key name",
    "variables_available" => "Variables available",
    "gotify" => "Gotify",
    "token" => "Token",
    "discord" => "Discord",
    "discord_bot_username" => "Discord Bot Username",
    "discord_bot_avatar_url" => "Discord Bot Avatar URL",
    "pushover" => "Pushover",
    "pushover_user_key" => "Pushover User Key",
    "host" => "Host",
    "topic" => "Topic",
    "ignore_ssl_errors" => "Ignore SSL Errors",
    "categories" => "Categories",
    "save_category" => "Save Category",
    "delete_category" => "Delete Category",
    "cant_delete_category_in_use" => "Can't delete category in use in subscription",
    "currencies" => "Currencies",
    "save_currency" => "Save currency",
    "delete_currency" => "Delete currency",
    "cant_delete_main_currency" => "Can't delete main currency",
    "cant_delete_currency_in_use" => "Can't delete currency in use in subscription",
    "exchange_update" => "Exchange rates last updated on",
    "currency_info" => "Find the supported currencies and correct currency codes on",
    "currency_performance" => "For improved performance keep only the currencies you use.",
    "fixer_api_key" => "Fixer API Key",
    "provider" => "Provider",
    "fixer_info" => "If you use multiple currencies, and want accurate statistics and sorting on the subscriptions, a FREE API Key from Fixer is necessary.",
    "get_key" => "Get your key at",
    "get_free_fixer_api_key" => "Get free Fixer API Key",
    "get_key_alternative" => "Alternatively, you can get a free fixer api key from",
    "display_settings" => "Display Settings",
    "theme_settings" => "Theme Settings",
    "colors" => "Colors",
    "custom_colors" => "Custom Colors",
    "theme" => "Theme",
    "dark_theme" => "Dark Theme",
    "light_theme" => "Light Theme",
    "automatic"=> "Automatic",
    "main_color" => "Main Color",
    "accent_color" => "Accent Color",
    "hover_color" => "Hover Color",
    "save_custom_colors" => "Save Custom Colors",
    "reset_custom_colors" => "Reset Custom Colors",
    "custom_css" => "Custom CSS",
    "save_custom_css" => "Save Custom CSS",
    "calculate_monthly_price" => "Calculate and show monthly price for all subscriptions",
    "convert_prices" => "Always convert and show prices on my main currency (slower)",
    "show_original_price" => "Also show original price when conversions or calculations are made",
    "experience" => "Experience",
    "show_subscription_progress" => "Show subscription progress",
    "disabled_subscriptions" => "Disabled Subscriptions",
    "hide_disabled_subscriptions" => "Hide disabled subscriptions",
    "show_disabled_subscriptions_at_the_bottom" => "Show disabled subscriptions at the bottom",
    "experimental_settings" => "Experimental Settings",
    "remove_background" => "Attempt to remove background of logos from image search",
    "use_mobile_navigation_bar" => "Use mobile navigation bar",
    "experimental_info" => "Experimental settings will probably not work perfectly.",
    "payment_methods" => "Payment Methods",
    "payment_methods_info" => "Click a payment method to disable / enable it.",
    "rename_payment_methods_info" => "Click the name on a payment method to rename it.",
    "cant_delete_payment_method_in_use" => "Can't disable used payment method",
    "add_custom_payment" => "Add Custom Payment Method",
    "payment_method_name" => "Payment Method Name",
    "payment_method_added_successfuly" => "Payment method added successfully",
    "payment_method_removed" => "Payment method removed",
    "disable" => "Disable",
    "enable" => "Enable",
    "rename_payment_method" => "Rename Payment Method",
    "payment_renamed" => "Payment method renamed",
    "payment_not_renamed" => "Payment method not renamed",
    "test" => "Test",
    "add" => "Add",
    "save" => "Save",
    "reset" => "Reset",
    "main_accent_color_error" => "Main and accent color can't be the same",
    "backup_and_restore" => "Backup and Restore",
    "backup" => "Backup",
    "restore" => "Restore",
    "restore_info" => "Restoring the database will override all current data. You will be signed out after the restore.",
    "account" => "Account",
    "export_subscriptions" => "Export Subscriptions",
    "export_as_json" => "Export as JSON",
    "export_as_csv" => "Export as CSV",
    "danger_zone" => "Danger Zone",
    "delete_account" => "Delete Account",
    "delete_account_info" => "Deleting your account will also delete all your subscriptions and settings.",
    // Filters menu
    "filter" => "Filter",
    "clear" => "Clear",
    // Toast
    "success" => "Success",
    // Endpoint responses
    "session_expired" => "Your session expired. Please login again",
    "fields_missing" => "Some fields are missing",
    "fill_all_fields" => "Please fill all fields",
    "fill_mandatory_fields" => "Please fill all mandatory fields",
    "error" => "Error",
    // Category
    "failed_add_category" => "Failed to add category",
    "failed_edit_category" => "Failed to edit category",
    "category_in_use" => "Category is in use in subscriptions and can't be removed",
    "failed_remove_category" => "Failed to remove category",
    "category_saved" => "Category saved",
    "category_removed" => "Category removed",
    "sort_order_saved" => "Sort order saved",
    // Currency
    "currency_saved" => "was saved.",
    "error_adding_currency" => "Error adding currency entry.",
    "failed_to_store_currency" => "Failed to store Currency on the Database.",
    "currency_in_use" => "Currency is in use in subscriptions and can't be deleted.",
    "currency_is_main" => "Currency is set as main currency and can't be deleted.",
    "failed_to_remove_currency" => "Failed to remove currency from the Database.",
    "failed_to_store_api_key" => "Failed to store API Key on the Database.",
    "invalid_api_key" => "Invalid API Key.",
    "api_key_saved" => "API key saved successfully",
    "currency_removed" => "Currency removed",
    // Household
    "failed_add_household" => "Failed to add household member",
    "failed_edit_household" => "Failed to edit household member",
    "failed_remove_household" => "Failed to remove household member",
    "household_in_use" => "Household member is in use in subscriptions and can't be removed",
    "member_saved" => "Member saved",
    "member_removed" => "Member removed",
    // Notifications
    "error_saving_notifications" => "Error saving notifications data.",
    "wallos_notification" => "Wallos Notification",
    "test_notification" => "This is a test notification. If you're seeing this, the configuration is correct.",
    "email_error" => "Error sending email",
    "notification_sent_successfuly" => "Notification sent successfully",
    "notifications_settings_saved" => "Notification settings saved successfully.",
    "notification_failed" => "Notification failed",
    // Payments
    "payment_in_use" => "Can't disable used payment method",
    "failed_update_payment" => "Failed to update payment method in the database",
    "enabled" => "enabled",
    "disabled" => "disabled",
    // Subscription
    "error_fetching_image" => "Error fetching image",
    "subscription_updated_successfuly" => "Subscription updated successfully",
    "subscription_added_successfuly" => "Subscription added successfully",
    "error_deleting_subscription" => "Error deleting subscription.",
    "invalid_request_method" => "Invalid request method.",
    // User
    "error_updating_user_data" => "Error updating user data.",
    "user_details_saved" => "User details saved",
    // Admin Page
    "registrations" => "Registrations",
    "enable_user_registrations" => "Enable user registrations",
    "maximum_number_users" => "Maximum number of users",
    "require_email_verification" => "Require email verification",
    "configure_smtp_settings_to_enable" => "Configure SMTP settings to enable",
    "server_url" => "Server URL",
    "server_url_info" => "Used for email verification and password recovery. Must be a valid public URL.",
    "server_url_password_reset" => "If set will also enable password reset functionality.",
    "disable_login" => "Disable login",
    "disable_login_info" => "Bypass login. If you run your server on a local network only, without external access you can disable the login. This will automatically login the admin user.",
    "disable_login_info2" => "You can only enable this setting if user registration is disabled and there are no more than the admin user account.",
    "max_users_info" => "0 means unlimited",
    "user_management" => "User Management",
    "delete_user" => "Delete User",
    "delete_user_info" => "Deleting a user will also delete all their subscriptions and settings.",
    "create_user" => "Create User",
    "smtp_settings" => "SMTP Settings",
    "smtp_usage_info" => "Will be used for password recovery and other system emails.",
    "maintenance_tasks" => "Maintenance Tasks",
    "orphaned_logos" => "Orphaned Logos",
    "update" => "Update",
    "new_version_available" => "A new version of Wallos is available",
    "current_version" => "Current Version",
    "latest_version" => "Latest Version",
    "on_current_version" => "You're running the latest version of Wallos.",
    "show_update_notification" => "Show notification for updates on the dashboard",
    "cronjobs" => "Cronjobs",
    // Email Verification
    "email_verified" => "Email verified successfully",
    "email_verification_failed" => "Email verification failed",
    // Calendar
    "calendar" => "Calendar",
    "sun" => "Sun",
    "mon" => "Mon",
    "tue" => "Tue",
    "wed" => "Wed",
    "thu" => "Thu",
    "fri" => "Fri",
    "sat" => "Sat",
    "month-01" => "January",
    "month-02" => "February",
    "month-03" => "March",
    "month-04" => "April",
    "month-05" => "May",
    "month-06" => "June",
    "month-07" => "July",
    "month-08" => "August",
    "month-09" => "September",
    "month-10" => "October",
    "month-11" => "November",
    "month-12" => "December",
    "total_cost" => "Total Cost",
    "export_icalendar" => "Export iCalendar",
    // TOTP Page
    "insert_totp_code" => "Insert TOTP code",


];


?>