<h1 align="center">Reports generator</h1>

**1.1** Create a "CRUD" of Profile with the fields "First Name", "Last name", "DBO" (date of birth) and "gender".

**1.2** Create a "CRUD" of Reports with the fields "Title" and "Description".

**1.3** A Report might have one or more Profiles associated with it, so create the relationship in the database.

**1.4** In the Report view page create a grid to show the Profiles associated with a Report.

**1.5** The system has to generate a PDF file and send it to an email after the user saves a Report (you can send the pdf file to your own email).

Extras:
- Using APIs to create profiles and reports.

- Adding design (CSS e JS) in the Report view page.

- Load JS e CSS using mix.

- Generating PDF described in the item **1.5** using Laravel queues. The system will send the information of the Report to the queue and the queue will return the PDf file.

<hr>

-  #### Requisites
    - PHP 8.1.6
    - Laravel 9.x
    - MySQL 10.4.24-MariaDB
