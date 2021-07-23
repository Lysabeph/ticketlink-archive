#!/bin/php

# Tests the user functions.
<?php

include "ConnectToDatabase.php";
include "GoToErrorPage.php";
include "IDGenerator.php";
include "UserFunctions.php";


# ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
# ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ Test: editBio() ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

#    editBio();

# ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~


# ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
# ~~~~~~~~~~~~~~~~~~~~~~~~~ Test: addUserToDatabase() ~~~~~~~~~~~~~~~~~~~~~~~~~

$conn = openConnectionToDatabase();

editBio(40323499, "This is a bio");

#print_r(json_decode(getUserInfo(74201104), true));

/*
addUserToDatabase("Another great test User", "unhashedpassword", "jeff", "bob",
                  "emailtocheckifhashworks@email.com", "", "");

closeConnectionToDatabase($conn);
 */
# ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~


# ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
# ~~~~~~~~~~~~~~~~~~~~~~~~ Test: changeEmailAddress() ~~~~~~~~~~~~~~~~~~~~~~~~~
#$conn = openConnectionToDatabase();

#changeEmailAddress("17149073", "newNewEmail@mail.com");
#closeConnectionToDatabase($conn);

# ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~


# ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
# ~~~~~~~~~~~~~~~~~~~~~~~~ Test: changePhoneNumber() ~~~~~~~~~~~~~~~~~~~~~~~~~~
 #$conn = openConnectionToDatabase();
 #changePhoneNumber("46672439", "6989820625");
 #closeConnectionToDatabase($conn);

# ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~


# ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
# ~~~~~~~~~~~~~~~~~~~~~~~~ Test: changeFacebookLink() ~~~~~~~~~~~~~~~~~~~~~~~~~
#$conn = openConnectionToDatabase();
#changeFacebookToken("73265712", "www.fb.com");
#closeConnectionToDatabase($conn);
# ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~


# ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
# ~~~~~~~~~~~~~~~~~~~~~~~ Test: checkUsernameAvailable() ~~~~~~~~~~~~~~~~~~~~~~

# checkUsernameAvailable();

# ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~


# ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
# ~~~~~~~~~~~~~~~~~~~~~~ Test: removeUserFromDatabase() ~~~~~~~~~~~~~~~~~~~~~~~
 #$conn = openConnectionToDatabase();
 #removeUserFromDatabase("13538983");
 #closeConnectionToDatabase($conn);
# ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~



# ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
# ~~~~~~~~~~~~~~~~~~~~~~~~~~ Test: addReviewToDatabase() ~~~~~~~~~~~~~~~~~~~~~~~~~~~
#$conn = openConnectionToDatabase();
#ddReviewToDatabase("40323499", "57278194", "1", "A review is an evaluation of a publication, service, or company such as a movie (a movie review), video game (video game review), musical composition (music review of a composition or recording), book (book review); a piece of hardware like a car, home appliance, or computer; or an event or performance, such as a live music concert, play, musical theater show, dance show, or art exhibition. In addition to a critical evaluation, the review's author may assign the work a rating to indicate its relative merit. , an author may review current events, trends, or items in the news. A compilation of reviews may itself be called a review. The New York Review of Books, for instance, is a collection of essays on literature, culture, and current affairs. National Review, founded by William F. Buckley, Jr.,[1] is an influential conservative magazine, and Monthly Review is a long-running socialist periodical");
#closeConnectionToDatabase($conn);
# ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~



# ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
# ~~~~~~~~~~~~~~~~~~~~~~~~~~ Test: changePassword() ~~~~~~~~~~~~~~~~~~~~~~~~~~~
/* $conn = openConnectionToDatabase();
 changePassword("40323499", "NewPassword");
 */
 closeConnectionToDatabase($conn);

# ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~


?>
