<?php

namespace App\Console\Commands;

use App\User;
use Illuminate\Console\Command;

class getWechatAvatar extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'users:get-wechat-avatar';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Save the user wechat avatar to storage';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $users = User::where('avatar', 'like', 'http%')->get();

        foreach ($users as $user) {
            $doNum = 1;

            do {
                if ($doNum > 1) echo 'user(ID:' . $user->id . ') avatar re-save' . "\n";
                if ($doNum > 3) break;
                $doNum++;

                $avatar = $this->saveAvatar($user);
            } while (str_is('http*', $avatar) || md5(file_get_contents(public_path($avatar))) == 'fee9458c29cdccf10af7ec01155dc7f0');

            if ($doNum > 3) {
                echo 'user(ID:' . $user->id . ') avatar not save' . "\n";
            } else {
                $user->avatar = $avatar;
                $user->save();

                echo 'user(ID:' . $user->id . ') avatar saved' . "\n";
            }
        }

        echo "\n\n" . 'complete';
    }

    protected function saveAvatar($user)
    {
        try {
            $path = 'uploads/users/avatars/' . $user->id . '.jpg';

            ini_set('default_socket_timeout', 1);
            $content = file_get_contents($user->avatar);
            \Storage::put($path, $content);

            return $path;
        } catch (\Exception $exception) {
            return $user->avatar;
        }
    }
}
