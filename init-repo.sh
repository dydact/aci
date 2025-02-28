#!/bin/bash

# Initialize Git repository
git init

# Add all files to Git
git add .

# Initial commit
git commit -m "Initial commit of iris EMR for American Caregivers Incorporated"

# Instructions for setting up remote repository
echo "Repository initialized successfully!"
echo ""
echo "To connect this to a GitHub repository, run the following commands:"
echo "  git remote add origin https://github.com/dydact/aci.git"
echo "  git push -u origin main"
echo ""
echo "Note: Make sure the repository https://github.com/dydact/aci.git exists first." 