<?php

use Illuminate\Support\Str;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up()
    {
        // From 000012.php - Add encryption to notifications
        Schema::table('notifications', function (Blueprint $table) {
            if (!Schema::hasColumn('notifications', 'encryption')) {
                $table->string('encryption')->default('tls');
            }
        });

        DB::table('notifications')->update(['encryption' => 'tls']);

        // From 000013.php - Update avatar paths
        // Add avatar column if it doesn't exist
        Schema::table('users', function (Blueprint $table) {
            if (!Schema::hasColumn('users', 'avatar')) {
                $table->string('avatar')->default('');
            }
        });

        // Update avatar paths for existing users
        DB::table('users')
            ->whereRaw('LENGTH(avatar) < 2')
            ->update(['avatar' => DB::raw("'images/avatars/' || avatar || '.svg'")]);

        // Update avatar paths for existing users
        DB::table('users')
            ->whereRaw('LENGTH(avatar) < 2')
            ->update(['avatar' => DB::raw("'images/avatars/' || avatar || '.svg'")]);

        // From 000014.php - Add color theme and custom colors
        if (!Schema::hasTable('settings')) {
            Schema::create('settings', function (Blueprint $table) {
                $table->foreignId('user_id')->constrained();
                $table->string('language')->default('en');
                $table->string('timezone')->default('UTC');
                $table->string('date_format')->default('Y-m-d');
                $table->string('time_format')->default('H:i');
                $table->string('currency_format')->default('symbol');
                $table->integer('first_day_of_week')->default(1);
                $table->boolean('dark_mode')->default(false);
                $table->string('color_theme')->default('blue');
                $table->timestamps();
            });
        } else {
            Schema::table('settings', function (Blueprint $table) {
                if (!Schema::hasColumn('settings', 'color_theme')) {
                    $table->string('color_theme')->default('blue');
                }
            });
        }

        DB::table('settings')->update(['color_theme' => 'blue']);

        if (!Schema::hasTable('custom_colors')) {
            Schema::create('custom_colors', function (Blueprint $table) {
                $table->string('main_color');
                $table->string('accent_color');
                $table->string('hover_color');
            });
        }

        // From 000015.php - Add hide_disabled to settings
        Schema::table('settings', function (Blueprint $table) {
            if (!Schema::hasColumn('settings', 'hide_disabled')) {
                $table->boolean('hide_disabled')->default(false);
                $table->boolean('disabled_to_bottom')->default(false);
                $table->boolean('show_original_price')->default(false);
                $table->boolean('mobile_nav')->default(false);
                $table->boolean('show_subscription_progress')->default(false);
            }
        });

        DB::table('settings')->update(['hide_disabled' => false]);

        // From 000016.php - Notification system overhaul
        if (!Schema::hasTable('telegram_notifications')) {
            Schema::create('telegram_notifications', function (Blueprint $table) {
                $table->foreignId('user_id')->constrained();
                $table->boolean('enabled')->default(false);
                $table->timestamps();
                $table->text('bot_token')->default('');
                $table->text('chat_id')->default('');
            });
        }

        if (!Schema::hasTable('webhook_notifications')) {
            Schema::create('webhook_notifications', function (Blueprint $table) {
                $table->foreignId('user_id')->constrained();
                $table->boolean('enabled')->default(false);
                $table->timestamps();
                $table->text('headers')->default('');
                $table->text('url')->default('');
                $table->string('request_method')->default('POST');
                $table->text('payload')->default('');
                $table->text('iterator')->default('');
                $table->boolean('ignore_ssl')->default(false);
            });
        }

        if (!Schema::hasTable('gotify_notifications')) {
            Schema::create('gotify_notifications', function (Blueprint $table) {
                $table->foreignId('user_id')->constrained();
                $table->boolean('enabled')->default(false);
                $table->timestamps();
                $table->text('url')->default('');
                $table->text('token')->default('');
                $table->boolean('ignore_ssl')->default(false);
            });
        }

        if (!Schema::hasTable('email_notifications')) {
            Schema::create('email_notifications', function (Blueprint $table) {
                $table->foreignId('user_id')->constrained();
                $table->boolean('enabled')->default(false);
                $table->string('email_address');
                $table->timestamps();
                $table->text('smtp_address')->default('');
                $table->integer('smtp_port')->default(587);
                $table->text('smtp_username')->default('');
                $table->text('smtp_password')->default('');
                $table->text('from_email')->default('');
                $table->string('encryption')->default('tls');
                $table->text('other_emails')->default('');
            });
        }

        if (!Schema::hasTable('notification_settings')) {
            Schema::create('notification_settings', function (Blueprint $table) {
                $table->foreignId('user_id')->constrained();
                $table->integer('notify_before')->default(3);
                $table->string('notify_before_unit')->default('days');
                $table->boolean('notify_on_day')->default(true);
                $table->integer('notify_after')->default(1);
                $table->string('notify_after_unit')->default('days');
                $table->boolean('notify_on_failure')->default(true);
                $table->boolean('notify_on_new_device')->default(true);
                $table->boolean('notify_on_password_change')->default(true);
                $table->timestamps();
            });
        }

        // From 000017.php - Additional notification methods
        if (!Schema::hasTable('pushover_notifications')) {
            Schema::create('pushover_notifications', function (Blueprint $table) {
                $table->foreignId('user_id')->constrained();
                $table->boolean('enabled')->default(false);
                $table->string('webhook_url');
                $table->string('bot_name');
                $table->string('bot_avatar')->nullable();
                $table->timestamps();
            });
        }

        if (!Schema::hasTable('discord_notifications')) {
            Schema::create('discord_notifications', function (Blueprint $table) {
                $table->foreignId('user_id')->constrained();
                $table->boolean('enabled')->default(false);
                $table->string('webhook_url');
                $table->string('bot_name');
                $table->string('bot_avatar')->nullable();
                $table->timestamps();
            });
        }

        if (!Schema::hasTable('gotify_notifications')) {
            Schema::create('gotify_notifications', function (Blueprint $table) {
                $table->foreignId('user_id')->constrained();
                $table->boolean('enabled')->default(false);
                $table->string('server_url');
                $table->string('app_token');
                $table->integer('priority')->default(5);
                $table->timestamps();
            });
        }

        // Migrate data from old notifications table if it exists
        if (Schema::hasTable('notifications')) {
            if (DB::table('notifications')->count() > 0) {
                DB::table('email_notifications')->insertUsing(
                    ['enabled', 'smtp_address', 'smtp_port', 'smtp_username', 'smtp_password', 'from_email', 'encryption'],
                    DB::table('notifications')
                        ->select('enabled', 'smtp_address', 'smtp_port', 'smtp_username', 'smtp_password', 'from_email', 'encryption')
                );

                DB::table('notification_settings')->insertUsing(
                    ['days'],
                    DB::table('notifications')->select('days')
                );
            }
            Schema::dropIfExists('notifications');
        }
    }

    public function down()
    {
        Schema::table('notifications', function (Blueprint $table) {
            $table->dropColumn('encryption');
        });

        Schema::dropIfExists('custom_colors');
        
        Schema::table('settings', function (Blueprint $table) {
            $table->dropColumn('color_theme');
            $table->dropColumn('hide_disabled');
        });

        Schema::dropIfExists('telegram_notifications');
        Schema::dropIfExists('webhook_notifications');
        Schema::dropIfExists('gotify_notifications');
        Schema::dropIfExists('email_notifications');
        Schema::dropIfExists('notification_settings');
        Schema::dropIfExists('pushover_notifications');
        Schema::dropIfExists('discord_notifications');

        // From 000027.php - TOTP authentication
        if (!Schema::hasTable('totp')) {
            Schema::create('totp', function (Blueprint $table) {
                $table->foreignId('user_id')->constrained();
                $table->text('totp_secret');
                $table->text('backup_codes');
                $table->integer('last_totp_used')->default(0);
            });
        }

        // From 000018.php - Add budget to users
        Schema::table('users', function (Blueprint $table) {
            if (!Schema::hasColumn('users', 'budget')) {
                $table->integer('budget')->default(0);
                $table->boolean('totp_enabled')->default(false);
                $table->string('api_key')->nullable();
            }
        });

        // Generate API keys for existing users
        DB::table('users')->whereNull('api_key')->each(function ($user) {
            DB::table('users')
                ->where('id', $user->id)
                ->update(['api_key' => bin2hex(random_bytes(32))]);
        });

        // From 000019.php - Add notify_days_before to subscriptions
        Schema::table('subscriptions', function (Blueprint $table) {
            if (!Schema::hasColumn('subscriptions', 'notify_days_before')) {
                $table->integer('notify_days_before')->default(0);
                $table->date('cancellation_date')->nullable();
                $table->foreignId('replacement_subscription_id')->nullable()->constrained('subscriptions');
            }
        });

        // From 000032.php - Add yearly cost tracking and subscription enhancements
        if (!Schema::hasTable('total_yearly_cost')) {
            Schema::create('total_yearly_cost', function (Blueprint $table) {
                $table->id();
                $table->foreignId('user_id')->constrained();
                $table->date('date');
                $table->decimal('cost', 10, 2);
                $table->string('currency', 3);
            });

            Schema::table('subscriptions', function (Blueprint $table) {
                if (!Schema::hasColumn('subscriptions', 'start_date')) {
                    $table->date('start_date')->nullable();
                    $table->boolean('auto_renew')->default(true);
                    }
                });
    
                // From 000034.php - Update notification days
                DB::table('subscriptions')
                    ->where('notify_days_before', 0)
                    ->update(['notify_days_before' => -1]);
    
                // From 000035.php - Clear yearly cost data
                DB::table('total_yearly_cost')->delete();
                DB::table('total_yearly_cost')->delete();
                DB::table('subscriptions')
                    ->where('notify_days_before', 0)
                    ->update(['notify_days_before' => -1]);
        }

        // From 000020.php - Multi-user support
        $tables = [
            'payment_methods', 'subscriptions', 'categories', 'currencies',
            'fixer', 'household', 'settings', 'custom_colors',
            'notification_settings', 'telegram_notifications',
            'webhook_notifications', 'gotify_notifications',
            'email_notifications', 'pushover_notifications',
            'discord_notifications', 'last_exchange_update'
        ];

        foreach ($tables as $table) {
            Schema::table($table, function (Blueprint $table) {
                if (!Schema::hasColumn($table, 'user_id')) {
                    $table->foreignId('user_id')->default(1)->constrained('users');
                }
            });
        }

        // Create admin table
        if (!Schema::hasTable('admin')) {
            Schema::create('admin', function (Blueprint $table) {
                $table->id();
                $table->boolean('registrations_open')->default(false);
                $table->integer('max_users')->default(0);
                $table->boolean('require_email_verification')->default(false);
                $table->text('server_url')->nullable();
                $table->text('smtp_address')->nullable();
                $table->integer('smtp_port')->default(587);
                $table->text('smtp_username')->nullable();
                $table->text('smtp_password')->nullable();
                $table->text('from_email')->nullable();
                $table->string('encryption')->default('tls');
                $table->boolean('login_disabled')->default(false);
                $table->string('latest_version')->default('v2.21.1');
                $table->boolean('update_notification')->default(false);
            });

            DB::table('admin')->insert([
                'registrations_open' => false,
                'require_email_verification' => false,
                'server_url' => '',
                'max_users' => 0,
                'smtp_address' => '',
                'smtp_port' => 587,
                'smtp_username' => '',
                'smtp_password' => '',
                'from_email' => '',
                'encryption' => 'tls'
            ]);
        }

        // Create auth tables
        if (!Schema::hasTable('email_verification')) {
            Schema::create('email_verification', function (Blueprint $table) {
                $table->id();
                $table->foreignId('user_id')->constrained();
                $table->string('email');
                $table->string('token');
                $table->boolean('email_sent')->default(false);
            });
        }

        if (!Schema::hasTable('password_resets')) {
            Schema::create('password_resets', function (Blueprint $table) {
                $table->id();
                $table->foreignId('user_id')->constrained();
                $table->string('email');
                $table->string('token');
                $table->timestamp('created_at')->useCurrent();
                $table->boolean('email_sent')->default(false);
            });
        }

        // Update payment method icons
        DB::table('payment_methods')
            ->where('id', '<', 32)
            ->where('icon', 'not like', '%/images/uploads/icons%')
            ->update(['icon' => DB::raw("CONCAT('images/uploads/icons/', icon)")]);

        // From 000021.php - Add ntfy notifications
        if (!Schema::hasTable('ntfy_notifications')) {
            Schema::create('ntfy_notifications', function (Blueprint $table) {
                $table->foreignId('user_id')->constrained();
                $table->boolean('enabled')->default(false);
                $table->timestamps();
                $table->text('host')->default('');
                $table->text('topic')->default('');
                $table->text('headers')->default('');
                $table->foreignId('user_id')->constrained();
            });
        }
    }
};
