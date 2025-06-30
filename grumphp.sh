if [ "$PANTHEON_ENVIRONMENT" ]; then
  exit 0
fi

if command -v ddev; then
  echo "Running GrumPHP tasks in DDEV environment"
  ddev php "$@"
elif command -v lando; then
  echo "Running GrumPHP tasks in Lando environment"
  lando php "$@"
else
  echo "Running GrumPHP tasks in local environment"
  php "$@"
fi
