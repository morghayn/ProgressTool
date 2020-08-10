DROP TABLE IF EXISTS `#__preliminary_question`;
DROP TABLE IF EXISTS `#__project_question_choice`;
DROP TABLE IF EXISTS `#__project`;
DROP TABLE IF EXISTS `#__question_choice`;
DROP TABLE IF EXISTS `#__question`;

CREATE TABLE `#__question`
(
    `id`        INT(11)      NOT NULL AUTO_INCREMENT,
    `question`  VARCHAR(255) NOT NULL,
    `colour` VARCHAR(6)   NOT NULL,
    PRIMARY KEY (`id`)
)
    ENGINE = InnoDB
    AUTO_INCREMENT = 0
    DEFAULT CHARSET = utf8mb4
    DEFAULT COLLATE = utf8mb4_unicode_ci;

CREATE TABLE `#__question_choice`
(
    `id`          INT(11)      NOT NULL AUTO_INCREMENT,
    `question_id` INT(11)      NOT NULL,
    `choice`      VARCHAR(255) NOT NULL,
    `weight`      tinyint(4)   NOT NULL DEFAULT '1',
    PRIMARY KEY (`id`),
    FOREIGN KEY (question_id) REFERENCES `#__question` (id)
)
    ENGINE = InnoDB
    AUTO_INCREMENT = 0
    DEFAULT CHARSET = utf8mb4
    DEFAULT COLLATE = utf8mb4_unicode_ci;

CREATE TABLE `#__project`
(
    `id`          INT(11)      NOT NULL AUTO_INCREMENT,
    `user_id`     INT(11)      NOT NULL, /* TODO is this a foreign key of user table? !!NEED TO RESEARCH!! */
    `name`        VARCHAR(255) NOT NULL,
    `description` VARCHAR(255),
    PRIMARY KEY (`id`)
)
    ENGINE = InnoDB
    AUTO_INCREMENT = 0
    DEFAULT CHARSET = utf8mb4
    DEFAULT COLLATE = utf8mb4_unicode_ci;

CREATE TABLE `#__project_question_choice`
(
    `project_id` INT(11) NOT NULL,
    `choice_id`  INT(11) NOT NULL,
    CONSTRAINT id PRIMARY KEY (project_id, choice_id),
    FOREIGN KEY (project_id) REFERENCES `#__project` (id),
    FOREIGN KEY (choice_id) REFERENCES `#__question_choice` (id)
)
    ENGINE = InnoDB
    AUTO_INCREMENT = 0
    DEFAULT CHARSET = utf8mb4
    DEFAULT COLLATE = utf8mb4_unicode_ci;

CREATE TABLE `#__preliminary_question`
(
    `id`       INT(11)      NOT NULL AUTO_INCREMENT,
    `question` VARCHAR(255) NOT NULL,
    PRIMARY KEY (`id`)
)
    ENGINE = InnoDB
    AUTO_INCREMENT = 0
    DEFAULT CHARSET = utf8mb4
    DEFAULT COLLATE = utf8mb4_unicode_ci;

INSERT INTO `#__question` (`question`, `colour`)
VALUES ('Has your community hosted awareness activities surrounding the energy transition?', 'ff6666'),
       ('Has there been exploratory discussions within the community about creating a renewable energy project?',
        'b366ff'),
       ('Has a group been formed to manage the energy transition and any renewable energy projects in your community?',
        'ff6666'),
       ('Has this group pursued any informal evaluation of the area to determine suitability?', '66ff8c'),
       ('Do the local authorities know this group? Is the group registered as an SEC with SEAI?', 'ff6666'),
       ('Has there been any meetings with potential partners or mentors?', 'b366ff');


INSERT INTO `#__question_choice` (`question_id`, `choice`, `weight`)
VALUES (1, 'No', 0),
       (2, 'No', 0),
       (3, 'No', 0),
       (3, 'No, but there is interest from the community to form one', 0),
       (4, 'No', 0),
       (5, 'No', 0),
       (6, 'No', 0);

INSERT INTO `#__question_choice` (`question_id`, `choice`)
VALUES (1, 'Yes, about existing beacons in ECCO and other Irish community group projects'),
       (1, 'Yes, about the actions of local authorities and their role in the transition'),
       (1,
        'Yes, there has been local initiatives about coming up with new ideas. These can include ‘Town hall’ meetings or '),
       (2,
        'Yes, regarding the type of governance that would be involved e.g. Co-operative or Sustainable Energy Community with SEAI (SEC)'),
       (2, 'Yes, regarding the financial structuring'),
       (2, 'Yes, regarding the type of partnerships available and if they would be suitable'),
       (2, 'Yes, regarding how to distribute benefits and profits among the local area'),
       (3,
        'Yes, there is a leading group that has been democratically organized and formed with members of the local community '),
       (3, 'Yes, legal, technical and financial structuring has been discussed '),
       (3, 'Yes, the goals and the values of the group have been outlined'),
       (3, 'Yes, the group has been officially founded as an association'),
       (4,
        'Yes, the group has investigated local resources that may be suitable for a RE project, i.e. available rooftop space, unused fields for wind turbines or readily available bioenergy fuel '),
       (4, 'Yes, the group has looked into grid connection feasibility'),
       (4, 'Yes, the group has consulted with ICEI for advise on the matter'),
       (5, 'Yes, the group has the support of local authorities such as SEAI'),
       (5, 'Yes, the group has official support from local bodies'),
       (5, 'Yes, agreements have been set up with the local authorities'),
       (5, 'Yes, contacts have been established within the local authorities'),
       (6, 'Yes, with public partners such as SEAI'),
       (6, 'Yes, with private partners (developers)'),
       (6, 'Yes, SEC mentors'),
       (6, 'Yes, with engineering office');

/* TODO give better descriptions for dummy data */
INSERT INTO `#__project` (`user_id`, `name`, `description`)
VALUES (1, 'Integration of renewable energy sources', 'N/A'),
       (1, 'Solar Electric Installation', 'N/A'),
       (1, 'Technology and Systems Upgrade', 'N/A');

INSERT INTO `#__preliminary_question` (`question`)
VALUES ('Has the group an idea of what they can do?'),
       ('Will the project be viable? Will the income generated cover the costs of the project?'),
       ('Has the group sought advice from other groups, and are they interested to do so?');