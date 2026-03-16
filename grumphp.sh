if [ "$PANTHEON_ENVIRONMENT" ]; then
  echo "Skipping GrumPHP tasks in Pantheon environment"
  exit 0
fi

if command -v ddev; then
  echo "Running GrumPHP tasks in DDEV environment"
  HOST_DIR="$(git rev-parse --show-toplevel)"
  CONTAINER_DIR="/var/www/html"
  ARGS=()
  for arg in "$@"; do
    arg="${arg/$HOST_DIR/$CONTAINER_DIR}"
    ARGS+=("$arg")
  done
  ddev php "${ARGS[@]}"
elif command -v lando; then
  echo "Running GrumPHP tasks in Lando environment"
  lando php "$@"
else
  echo "Running GrumPHP tasks in local environment"
  php "$@"
fi
