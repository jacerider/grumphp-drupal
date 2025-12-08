if [ "$PANTHEON_ENVIRONMENT" ]; then
  echo "Skipping GrumPHP tasks in Pantheon environment"
  exit 0
fi

if command -v ddev; then
  echo "Running GrumPHP tasks in DDEV environment"
  ddev ssh
  touch .git/COMMIT_EDITMSG
  exit
  ddev php "$@"
elif command -v lando; then
  echo "Running GrumPHP tasks in Lando environment"
  lando php "$@"
else
  echo "Running GrumPHP tasks in local environment"
  php "$@"
fi
