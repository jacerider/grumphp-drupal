if command -v lando; then
  echo "Running GrumPHP tasks in Lando environment"
  lando php "$@"
elif command -v ddev; then
  echo "Running GrumPHP tasks in DDEV environment"
  ddev php "$@"
else
  echo "Running GrumPHP tasks in local environment"
  php "$@"
fi
