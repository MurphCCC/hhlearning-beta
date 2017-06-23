This is the latest revision of the Hilger teacher student grading form.  This is still a work in progress.  It is a complete rewrite of the current application.  For this version I am using a Material bootstrap admin dashboard theme.  Here are some of the key changes planned:


  * **Database Structure**
    - Instead of using one table to hold students and courses I have broken it up into two separate tables.  One table holds the students name and id.  Another table is just for classes.  When a teacher adds a class to a student, an entry in the courses table is created and assigned the students id as well as the teachers id and a unique course id.  This way we can look up courses by student or by teacher and we don't have an arbitrary number of courses for every student.  

    This should also eliminate any possible overwriting of data.  The previous model had 14 courses for each student and worked in a sort of lottery mode where when a teacher clicked on a student, the row for that student was checked and the next empty course was assigned to that teacher and their name was put into the teacher field for that course.  With the new model, when a teacher clicks on a student, if their are no courses assigned to that student/teacher combo, then a new one will be created.  If their are courses that match that teacher/student combo then they will be displayed.

  * **Admin mode**
    - This is another major feature.  With the previous app their was no easy way for a single teacher to make edits to students courses, other than the ones they were assigned to.  This is fine most of the time, but when it is time for report cards, their needs to be an admin user who can go through each student/course and make sure they were good to go.  Also, if a teacher was sick or otherwise unable to finish editing her students for some reason, then they would end up sharing their password with another teacher and having them login for them.

    - This will be addressed by creating an "Admin Mode" and giving access to this to a certain group of teachers.  They will have a toggle button that will switch between teacher/admin mode.

    - When a teacher is in "teacher" mode, they will only be able to see student/courses that are assigned to them.  They will not be able to add or delete students and they will not be able to see courses for other teachers for a particular student.  This is no different than how things currently work.

    - When a teacher is in "admin" mode, they will have access to add and delete students.  In addition, when they click on a student, they will be able to see all courses assigned to that student as well as the teacher's name assigned to that course.  They will be able to edit that information as well including the students first and last name.

  * **Student's sidebar**
    - The new app will also feature a sidebar.  Their will be an icon near the upper right of the screen.  When a teacher clicks on this icon it will open a sidebar containing a list of all the students that are assigned to this teacher.  This is meant to be a convenient way for a teacher to access the students that are assigned to them without having to search through the main list of students.

  * **Improved student list and search feature**
   - Another minor improvement in this version is the implementation of the list of students and the search feature.  Previously whenever the page containing the list of students was loaded, a call was made to the database to select all of the students, loop through them and display them in a list.  Although their is not a lot of data it is still a waste.  Now instead of querying the database on every page load, I have written it so that the database is queried once manually and this information is placed into a JSON file on the server.  This file is then loaded with the page and put into the list.  Additionally, anytime that a student is added or deleted this script will run again in order to update the JSON file.  

   - This allows this page to load much faster, it also allows for added flexibility in the search functionality.  Now a teacher is able to select whether to display 10, 50 or 100 students at a time and they are able to page through the list.  Teachers will also be able to Sort the list by the students first name or last name as well as search for individual students.  
