<?php
// index.php
// Set a custom title for this page
$pageTitle = 'My Website Home Page';


// Include header which will output the DOCTYPE and opening tags
include 'header.php';


// Include the sidebar
include 'sidebar.php';
?>


<section class="site-content">
<h2>Welcome learners</h2>
<p>This page shows how to use PHP include to reuse header, sidebar and footer code. The layout is made with CSS Grid and only the columns are declared in CSS.</p>


<p>Try changing the value of the <code>$pageTitle</code> variable at the top of this file and refresh the page to see the title update across the header and the browser tab.</p>


<h3>How includes work</h3>
<p>The include statement simply inserts the contents of the named file at that point. It is a good way to avoid repeating markup across multiple pages.</p>
</section>


<?php
// Include footer which closes the main and body tags
include 'footer.php';