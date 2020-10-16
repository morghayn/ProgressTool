UPDATE `#__pt_approval_question` AS AQ
SET AQ.`question` = "Has the group thought about how to finance the project?"
WHERE AQ.`id` = 2;

UPDATE `#__pt_question` AS Q
SET Q.`question` = "Has the group began planning how to raise equity for the project?"
WHERE Q.`id` = 21;

UPDATE `#__pt_question` AS Q
SET Q.`question` = "How will the construction phase of the project be financed?"
WHERE Q.`id` = 25;