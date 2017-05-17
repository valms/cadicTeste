# config valid only for current version of Capistrano
lock "3.8.1"

set :application, "cadicTeste"
set :repo_url, "https://github.com/valms/cadicTeste.git"

set :scm, :git
set :branch, 'master'
set :git_strategy, Capistrano::Git::SubmoduleStrategy

# Default value for :format is :pretty
# set :format, :pretty

# Default value for :log_level is :debug
# set :log_level, :debug

# Default value for :pty is false
# set :pty, true

# Default value for :linked_files is []
# set :linked_files, %w{config/database.yml}

# Default value for linked_dirs is []
set :linked_dirs, %w{app/tmp app/webroot/files}

# Default value for tmp_dirs is []
set :tmp_dirs, %w{app/tmp app/tmp/logs app/tmp/sessions app/tmp/cache app/tmp/cache/models app/tmp/cache/persistent app/tmp/cache/views app/webroot/files}

# Default value for default_env is {}
# set :default_env, { path: "/opt/ruby/bin:$PATH" }

# Default value for keep_releases is 5
set :keep_releases, 3

# files_to_remove: array of files to delete at the end of deployment.
set :files_to_remove, %w{app/webroot/css/cake*.css app/webroot/img/cake.* app/webroot/img/test-*.png app/webroot/test.php}


namespace :deploy do

  desc "CakePHP Migrations"
  task :migrate do
    on roles(:db) do
      execute "export CAKE_ENV=#{fetch(:stage)}; yes | #{release_path}/lib/Cake/Console/cake -app #{release_path}/app Migrations.migration run all"
    end
  end

  desc 'Restart application'
  task :restart do
    # on roles(:app), in: :sequence, wait: 5 do
      # Your restart mechanism here, for example:
      # execute :touch, release_path.join('tmp/restart.txt')
    # end
  end

  after :finishing, 'deploy:cleanup'

end

namespace :misc do

  desc "Delete any files defined in :files_to_remove."
  task :file_cleanup do
    on roles(:app) do
      files = fetch(:files_to_remove)
      if files.is_a?(Array)
        files.each do |f|
          path = release_path.join(f)
          execute "rm -rf #{path}"
        end
      end
    end
  end

  desc "Fix permission in :tmp_dirs."
  task :fix_premission do
    on roles(:app) do
      dirs = fetch(:tmp_dirs)
      if dirs.is_a?(Array)
        dirs.each do |d|
          path = shared_path.join(d)
          if test "[ ! -d #{path} ]"
            execute "mkdir -p #{path}"
          end
          execute "chmod 0777 #{path}"
        end
      end
    end
  end

  desc "normalize assets timestamp"
  task :normalize_asset_timestamp do
    on roles(:app) do
      if fetch(:normalize_asset_timestamps, true)
        stamp = Time.now.strftime("%Y%m%d%H%M.%S")
        asset_paths = %w(img css js).map { |p| "#{release_path}/app/webroot/#{p}" }.join(" ")
        execute "find #{asset_paths} -exec touch -t #{stamp} {} ';'; true"
      end
    end
  end

end

after 'deploy:finished', 'misc:file_cleanup'
after 'deploy:finished', 'misc:fix_premission'
after 'deploy:finished', 'misc:normalize_asset_timestamp'


# Default branch is :master
# ask :branch, `git rev-parse --abbrev-ref HEAD`.chomp

# Default deploy_to directory is /var/www/my_app_name
# set :deploy_to, "/var/www/my_app_name"

# Default value for :format is :airbrussh.
# set :format, :airbrussh

# You can configure the Airbrussh format using :format_options.
# These are the defaults.
# set :format_options, command_output: true, log_file: "log/capistrano.log", color: :auto, truncate: :auto

# Default value for :pty is false
# set :pty, true

# Default value for :linked_files is []
# append :linked_files, "config/database.yml", "config/secrets.yml"

# Default value for linked_dirs is []
# append :linked_dirs, "log", "tmp/pids", "tmp/cache", "tmp/sockets", "public/system"

# Default value for default_env is {}
# set :default_env, { path: "/opt/ruby/bin:$PATH" }

# Default value for keep_releases is 5
# set :keep_releases, 5
