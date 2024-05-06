# SeekWork: Freelancing Platform for Undergraduates

SeekWork is a web application designed to connect university students with freelancing opportunities. Whether you're a student looking for part-time work or an employer seeking talented undergraduates, SeekWork has you covered. Here's an overview of the platform's features and how it was developed:

## Some of the Features

1. **Task Posting and Assigning:**
   - Companies can post tasks or projects they need assistance with.
   - Students can browse available tasks and submit proposals.
   - Task assignment and communication happen within the platform.

2. **Dispute Resolution:**
   - A built-in system for resolving disputes between companies and students.
   - Ensures fair treatment and transparent communication.

3. **Proposal Submission and Bidding:**
   - Students submit detailed proposals for tasks they're interested in.
   - Employers review proposals and choose the best fit.

4. **Task Browsing:**
   - Students can explore available tasks based on categories, skills, and deadlines.

5. **Category Management:**
   - Organize tasks into relevant categories (e.g., programming, design, writing).

6. **Authentication and Verification:**
   - Verify student identities using university email domains and OTP (One-Time Password) through email.
   - Verify company identities using OTP (One-Time Password) through email.

7. **Notification System:**
   - Real-time notifications for task updates, messages, and other important events.

8. **Email Reminders:**
   - Send automated reminders to students and employers regarding deadlines and milestones.

9. **Real-time Chat Application (AJAX):**
   - Facilitate communication between students and employers within the platform.
   - Can share images, documents and show the status of messages (sent, delivered,read).

10. **Review and Rating Module:**
    - Students and companies can rate each other after completing tasks.
    - Calculate average ratings for users.

11. **Task Recommendation System:**
    - Match student skills with preferred task skills for personalized task recommendations.

12. **Auction and Fixed Price Tasks:**
    - Companies can choose between auction-style bidding or fixed-price tasks.

13. **Submission Management:**
    - Facilitate management of submissions for tasks and reviewing of them

14. **Integration of Payment Gateway (PayHere):**
    - Secure payment processing for completed tasks.
    
15. **Audit Logs:**
    - Logs about database changes using triggers
    - Logs web activity using MonoLog
    - 
## Technology Stack

- **Front-End:**
  - HTML, CSS, JavaScript (No frameworks used)
- **Back-End:**
  - PHP (for server-side logic, without frameworks)
  - MySQL (for database management)
- **Deployment:**
  - Docker for easier development and deployment

## Getting Started

1. Clone this repository:
```
https://github.com/chathura226/SeekWork_Group_Project_I
```
2. **Run the application using docker:**
   - Navigate to the 'docker' directory and open a terminal.
   - Start the Docker containers and run the project:
     - For Linux
          ```
          ./seekwork.sh up
          ```
     - For Windows
          ```
          seekwork up
          ```
     
   - Access the application in your browser at :
     ```
         Seekwork will be running @ : http://localhost/public
         phpMyAdmin will be running @ http://localhost:8001
     ```
   - MySql dump will be imported and loaded automatically

3. **Stopping the applicaiton:**
   - Navigate to the 'docker' directory and open a terminal.
   - End the Docker containers and stop the project:
     - For Linux
          ```
          ./seekwork.sh down
          ```
     - For Windows
          ```
          seekwork down
          ```

   - This will dump the database to 'db' directory and will be used for next run

These bash files and bat files contains docker-compose and docker commands that are necessary to run.

# Special Note
 - When deploying,
   - change the root in main app and chat app config files.
 - All secrets and app passwords are revoked. So use your own keys when necessary

## Some Screenshots