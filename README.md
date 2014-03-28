Tecol Website
=============
Meeting Dimo - 28.03.2014
-------------------------
Results:
Administartive Page requirements: Monday (31.03.2014)
Suggestions for improving the website desing and General Look: : Friday (05.04.2014)
Formula for Report and Text finalized at the meeting:  Thursday, Friday (08-09.05.2014)

Project Meeting Results:
=======================
Var types explained:
--------------------
1- Country id
2- Text (2000 char)
3- Big-int 64-bit
4- Boolean - Requires answer(important for questions form)
5- Boolean - Doesn't require answe (important for questions form)
5- Percentage (int I guess, no restrictions)
6- percentage (int all must be under 100%, and C17≥C18≥C19……≥C22 actually their sum must be under that value but it's okey this way )

*B21 is actually a number
General Structure: 
 Index - Login - Home - Worksheet - About - Administrator

Worksheet:
-Line with possible new worksheet forms
-List of existing Worksheets

Viewing of a Worksheet:
-List of Questions (Editable)
-Generate Report
-Delete Worksheet
 
Questions:
Question displayed from database information, in concordance with requirements and then saved skipped or answered later.
Prev -> Goes to Previous question of there is one (maybe it shouldn't be displayed if there exists none)
Next -> Next question if exists
Question Body | Hint | List of all the variables it requires with variable type query for correctness
Skip- Button, saves answer as skipped, goes to next question
Save - Saves answers if correct to database if not error report

Needs info : Question number; Worksheet Number; Username; Country selected;


Project Description:
--------------------
In a nutshell: We need software to build in a form of on-line questioner. The questioner will have 51 questions (please see the complete list below) and after each question a hint for the user of where to find the required information will be given.  After the user fill the questioner the software will generate report using ‘fixed’ text and the information provided by the user, the software also will give level of possibility for the cartel existence and will advice users to proceed in certain way.

Functionality:
--------------
First we need the user to be able to securely log in and have his own account. The exact manner snd details of logging in and security we leave for the software engineers to choose.
 In this account the user should be able to save up to 5 different worksheets, as each worksheet is a new questioner for the same or different industry and/or country.  The user should be able to choose his worksheets questioner to be about structural approach (questions 1- 18) ; CFD approach (questions  1 and 2 and questions 19-51) or both (questions 1-51). When logging in the user should be able to see his existing worksheets (if any) and be able to start a new worksheet if his worksheets are less than 5.
 At any given time the worksheet should be able to generate report ( generate report button is a required).
During answering the questions the user should be able to save the answer of each question and by hitting save the software should keep the entry in database 1. The user should also be able to edit his answers at latter time so save and edit buttons  in each questions are a must.
While doing the questioner the user should be able to choose to skip 1 or more questions (button skip is required in each question), skipping will mean the user cannot find or doesn’t want to show the information in the report, which would mean that from this question will not generate any text in the report.
Finally the user could just wish to browse through the questions so next and previous should also feature as options under each question. 
The worksheet should show in a clear way which of the questions are saved, which skipped and which have not been assigned function; we recommend different colors to be assigned for each 


