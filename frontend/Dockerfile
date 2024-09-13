# Use the official Node.js image as the base image
FROM node:14

# Set the working directory
WORKDIR /app

# Install create-react-app globally
RUN npm install -g create-react-app

# Initialize a new React project
RUN npx create-react-app my-app

# Change working directory to the newly created React app
WORKDIR /app/my-app

# Expose the port the app runs on
EXPOSE 3000

# Start the application
CMD ["npm", "start"]