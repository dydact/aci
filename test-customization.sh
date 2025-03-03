#!/bin/bash
# iris-emr Customization Test Script

echo "Testing iris EMR customizations for American Caregivers Incorporated..."

# Function to check if containers are running
check_containers() {
  echo "Checking if Docker containers are running..."
  
  # Check MySQL container
  if [ "$(docker ps -q -f name=mysql)" ]; then
    echo "✅ MySQL container is running."
  else
    echo "❌ MySQL container is not running!"
    return 1
  fi
  
  # Check iris-emr container
  if [ "$(docker ps -q -f name=iris-emr)" ]; then
    echo "✅ iris-emr container is running."
  else
    echo "❌ iris-emr container is not running!"
    return 1
  fi
  
  return 0
}

# Function to test database customizations
test_database_customizations() {
  echo "Testing database customizations..."
  
  # Execute database queries to verify customizations
  echo "Checking branding in database..."
  BRANDING=$(docker exec mysql mysql -u admin -piris aci-EMR -e "SELECT gl_value FROM globals WHERE gl_name='openemr_name'" --skip-column-names 2>/dev/null)
  
  if [ "$BRANDING" == "iris" ]; then
    echo "✅ Database branding is correct: '$BRANDING'"
  else
    echo "❌ Database branding is incorrect: '$BRANDING' (should be 'iris')"
  fi
  
  # Check tagline
  TAGLINE=$(docker exec mysql mysql -u admin -piris aci-EMR -e "SELECT gl_value FROM globals WHERE gl_name='login_tagline_text'" --skip-column-names 2>/dev/null)
  
  if [ "$TAGLINE" == "Powered by dydact LLMs" ]; then
    echo "✅ Tagline is correct: '$TAGLINE'"
  else
    echo "❌ Tagline is incorrect: '$TAGLINE' (should be 'Powered by dydact LLMs')"
  fi
}

# Function to test web access
test_web_access() {
  echo "Testing web access..."
  
  # Check HTTP redirect to /iris
  HTTP_CODE=$(curl -s -o /dev/null -w "%{http_code}" http://localhost/)
  
  if [ "$HTTP_CODE" == "302" ] || [ "$HTTP_CODE" == "301" ]; then
    echo "✅ Root URL redirects correctly (HTTP $HTTP_CODE)"
  else
    echo "❌ Root URL does not redirect (HTTP $HTTP_CODE, should be 301 or 302)"
  fi
  
  # Try to access the iris path
  IRIS_CONTENT=$(curl -s http://localhost/iris/ | grep -o "iris" | head -1)
  
  if [ "$IRIS_CONTENT" == "iris" ]; then
    echo "✅ /iris path is accessible and contains 'iris' branding"
  else
    echo "❌ /iris path is not accessible or does not contain 'iris' branding"
  fi
}

# Main test sequence
main() {
  echo "Starting tests..."
  
  # Check if containers are running
  if ! check_containers; then
    echo "❌ Containers are not running. Please start them with 'docker-compose up -d'"
    exit 1
  fi
  
  # Wait a moment for services to be fully initialized
  echo "Waiting for services to initialize..."
  sleep 5
  
  # Run database tests
  test_database_customizations
  
  # Run web access tests
  test_web_access
  
  echo "All tests completed!"
}

# Run the main test sequence
main 