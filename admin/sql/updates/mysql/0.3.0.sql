DROP TABLE IF EXISTS `#__pt_project_approval`;
DROP TABLE IF EXISTS `#__pt_project_choice`;
DROP TABLE IF EXISTS `#__pt_question_choice`;
DROP TABLE IF EXISTS `#__pt_question_country`;
DROP TABLE IF EXISTS `#__pt_exclude`;
DROP TABLE IF EXISTS `#__pt_country`;
DROP TABLE IF EXISTS `#__pt_question`;
DROP TABLE IF EXISTS `#__pt_project`;
DROP TABLE IF EXISTS `#__pt_approval_question`;
DROP TABLE IF EXISTS `#__pt_category`;

/**/

CREATE TABLE `#__pt_approval_question`
(
    `id`       TINYINT UNSIGNED NOT NULL AUTO_INCREMENT,
    `question` VARCHAR(255)     NOT NULL,
    PRIMARY KEY (`id`)
)
    ENGINE = InnoDB
    AUTO_INCREMENT = 0
    DEFAULT CHARSET = utf8mb4
    DEFAULT COLLATE = utf8mb4_unicode_ci;

INSERT INTO `#__pt_approval_question` (`question`)
VALUES ('Has the group an idea of what they can do?'),
       ('Will the project be viable? Will the income generated cover the costs of the project?'),
       ('Has the group sought advice from other groups, and are they interested to do so?');

/**/

CREATE TABLE `#__pt_category`
(
    `id`         TINYINT UNSIGNED NOT NULL AUTO_INCREMENT,
    `category`   VARCHAR(255)     NOT NULL,
    `colour_hex` VARCHAR(7)       NOT NULL DEFAULT ('#ffffff'),
    `colour_rgb` VARCHAR(13)      NOT NULL DEFAULT ('255, 255, 255'),
    PRIMARY KEY (`id`)
)
    ENGINE = InnoDB
    AUTO_INCREMENT = 0
    DEFAULT CHARSET = utf8mb4
    DEFAULT COLLATE = utf8mb4_unicode_ci;

INSERT INTO `#__pt_category` (`id`, `category`, `colour_hex`, `colour_rgb`)
VALUES (1, 'People', '#f7a58a', '247, 165, 138'), /* RED-ORANGE */
       (2, 'Finance', '#9690c6', '150, 144, 198'), /* PURPLE */
       (3, 'Technology', '#95d0ab', '149, 208, 171'); /* GREEN */
/* Old Values
VALUES (1, 'People', '#ff6666', '255, 102, 102'),
(2, 'Finance', '#b366ff', '179, 102, 255'),
(3, 'Technology', '#66ff8c', '102, 255, 140'),
 */

/* */

CREATE TABLE `#__pt_question`
(
    `id`          SMALLINT UNSIGNED NOT NULL AUTO_INCREMENT,
    `category_id` TINYINT UNSIGNED  NOT NULL,
    `question`    VARCHAR(255)      NOT NULL,
    PRIMARY KEY (`id`),
    FOREIGN KEY (`category_id`) REFERENCES `#__pt_category` (id)
)
    ENGINE = InnoDB
    AUTO_INCREMENT = 0
    DEFAULT CHARSET = utf8mb4
    DEFAULT COLLATE = utf8mb4_unicode_ci;

INSERT INTO `#__pt_question` (`id`, `category_id`, `question`)
    /* Irish */
VALUES (1, 1, 'Has your community hosted awareness activities surrounding the energy transition?'),
    /* Universal - Irish Exclusion */
       (2, 1, 'Has your community hosted awareness activities surrounding the energy transition?'),
    /* Irish */
       (3, 2, 'Has there been exploratory discussions within the community about creating a renewable energy project?'),
    /* Universal - Irish Exclusion */
       (4, 2, 'Has there been exploratory discussions within the community about creating a renewable energy project?'),
       (5, 1, 'Has a group been formed to manage the energy transition and any renewable energy projects in your community?'),
    /* Irish */
       (6, 3, 'Has this group pursued any informal evaluation of the area to determine suitability?'),
    /* Universal - Irish Exclusion */
       (7, 3, 'Has this group pursued any informal evaluation of the area to determine suitability?'),
    /* Irish */
       (8, 1, 'Do the local authorities know this group? Is the group registered as an SEC with SEAI?'),
    /* Universal - Irish Exclusion */
       (9, 1, 'Do the local authorities know this group?'),
    /* Irish */
       (10, 2, 'Has there been any meetings with potential partners or mentors?'),
    /* Universal - Irish Exclusion */
       (11, 2, 'Has there been any meetings with potential partners or mentors?'),
    /* Irish */
       (12, 3, 'Has a preliminary evaluation of the territory been completed? Has an Energy Master Plan been carried out for the community?'),
    /* Universal - Irish Exclusion */
       (13, 3, 'Has a preliminary evaluation of the territory been completed?'),
       (14, 3, 'Following the preliminary evaluation of the territory, has a decision been made regarding project choice?'),
       (15, 3, 'Has a feasibility study been carried out for the selected Renewable Energy Project?'),
       (16, 3, 'Has a land leasing commitment been agreed?'),
       (17, 2, 'Is there a finance plan agreed within the group?'),
       (18, 1, 'Has the local community group become a project society?'),
    /* Irish */
       (19, 3, 'Has a technical committee been established within the group?'),
    /* Universal - Irish Exclusion */
       (20, 1, 'Has a technical committee been established within the group?'),
       (21, 2, 'Has the group organized to raise equity for construction or other projects?'),
       (22, 3,
        'Is there a technical file for planning permission to be submitted for administration approval? This file will contain a report from any studies carried out and other documents required by authorities to give planning permission for the project.'),
       (23, 3, 'Was the file approved?'),
       (24, 2, 'Is the financial plan finalized?'),
       (25, 2, 'Has there been fundraising measures or bank loans for the construction phase?'),
       (26, 3, 'Has the construction contracts been signed?'),
       (27, 1, 'Has a plan for project management been agreed upon?'),
       (28, 3, 'Has construction commenced?'),
       (29, 1, 'Is the site operational?'),
       (30, 2, 'Is there a financial management scheme in place for the project?'),
       (31, 3, 'Is the group partaking in monitoring the project?'),
       (32, 1, 'Has the community group maintained strong bonds with the local citizens?'),
       (33, 1, 'Has there been further educational activities in your community?');

/* */

CREATE TABLE `#__pt_country`
(
    `id`      TINYINT UNSIGNED NOT NULL AUTO_INCREMENT,
    `country` VARCHAR(60)      NOT NULL,
    PRIMARY KEY (`id`)
)
    ENGINE = InnoDB
    AUTO_INCREMENT = 0
    DEFAULT CHARSET = utf8mb4
    DEFAULT COLLATE = utf8mb4_unicode_ci;

INSERT INTO `#__pt_country` (`country`)
VALUES ('Universal'),
       ('Ireland');

/* */

CREATE TABLE `#__pt_question_country`
(
    `question_id` SMALLINT UNSIGNED NOT NULL,
    `country_id`  TINYINT UNSIGNED  NOT NULL,
    CONSTRAINT id PRIMARY KEY (`question_id`, `country_id`),
    FOREIGN KEY (`question_id`) REFERENCES `#__pt_question` (`id`),
    FOREIGN KEY (`country_id`) REFERENCES `#__pt_country` (`id`)
)
    ENGINE = InnoDB
    AUTO_INCREMENT = 0
    DEFAULT CHARSET = utf8mb4
    DEFAULT COLLATE = utf8mb4_unicode_ci;

INSERT INTO `#__pt_question_country` (`question_id`, `country_id`)
VALUES (1, 2),
       (2, 1),
       (3, 2),
       (4, 1),
       (5, 1),
       (6, 2),
       (7, 1),
       (8, 2),
       (9, 1),
       (10, 2),
       (11, 1),
       (12, 2),
       (13, 1),
       (14, 1),
       (15, 1),
       (16, 1),
       (17, 1),
       (18, 1),
       (19, 2),
       (20, 1),
       (21, 1),
       (22, 1),
       (23, 1),
       (24, 1),
       (25, 1),
       (26, 1),
       (27, 1),
       (28, 1),
       (29, 1),
       (30, 1),
       (31, 1),
       (32, 1),
       (33, 1);

/* */

CREATE TABLE `#__pt_exclude`
(
    `question_id` SMALLINT UNSIGNED NOT NULL,
    `country_id`  TINYINT UNSIGNED  NOT NULL,
    CONSTRAINT id PRIMARY KEY (`question_id`, `country_id`),
    FOREIGN KEY (`question_id`) REFERENCES `#__pt_question` (`id`),
    FOREIGN KEY (`country_id`) REFERENCES `#__pt_country` (`id`)
)
    ENGINE = InnoDB
    AUTO_INCREMENT = 0
    DEFAULT CHARSET = utf8mb4
    DEFAULT COLLATE = utf8mb4_unicode_ci;

INSERT INTO `#__pt_exclude` (`question_id`, `country_id`)
VALUES (2, 2),
       (4, 2),
       (7, 2),
       (9, 2),
       (11, 2),
       (13, 2),
       (20, 2);

/* */

CREATE TABLE `#__pt_question_choice` /* TODO: Make question_id, choice_id a composite primary key, must conduct tests */
(
    `id`          TINYINT UNSIGNED  NOT NULL AUTO_INCREMENT,
    `question_id` SMALLINT UNSIGNED NOT NULL,
    `choice`      VARCHAR(255)      NOT NULL,
    `weight`      TINYINT UNSIGNED  NOT NULL DEFAULT '1',
    PRIMARY KEY (`id`),
    FOREIGN KEY (question_id) REFERENCES `#__pt_question` (id)
)
    ENGINE = InnoDB
    AUTO_INCREMENT = 0
    DEFAULT CHARSET = utf8mb4
    DEFAULT COLLATE = utf8mb4_unicode_ci;

INSERT INTO `#__pt_question_choice` (`question_id`, `choice`) /* TODO: Include weight */
VALUES (1, 'No'),
       (1, 'Yes, about existing beacons in ECCO and other Irish community group projects'),
       (1, 'Yes, about the actions of local authorities and their role in the transition'),
       (1, 'Yes, there has been local initiatives about coming up with new ideas'),

       (2, 'No'),
       (2, 'Yes, about existing beacons in ECCO'),
       (2, 'Yes, about the actions of local authorities and their role in the transition'),
       (2, 'Yes, there has been local initiatives about coming up with new ideas'),

       (3, 'No'),
       (3, 'Yes, regarding the type of governance that would be involved e.g. Co-operative or Sustainable Energy Community with SEAI (SEC)'),
       (3, 'Yes, regarding the financial structuring'),
       (3, 'Yes, regarding the type of partnerships available and if they would be suitable'),
       (3, 'Yes, regarding how to distribute benefits and profits among the local area'),

       (4, 'No'),
       (4, 'Yes, regarding the type of governance that would be involved e.g. Co-operative'),
       (4, 'Yes, regarding the financial structuring'),
       (4, 'Yes, regarding the type of partnerships available and if they would be suitable'),
       (4, 'Yes, regarding how to distribute benefits and profits among the local area'),

       (5, 'No'),
       (5, 'No, but there is interest from the community to form one'),
       (5, 'Yes, there is a leading group that has been democratically organized and formed with members of the local community'),
       (5, 'Yes, legal, technical and financial structuring has been discussed '),
       (5, 'Yes, the goals and the values of the group have been outlined'),
       (5, 'Yes, the group has been officially founded as an association'),

       (6, 'No'),
       (6, 'Yes, the group has completed the Technology Decision Plan tool to determine the suitable choice of Renewable Energy'),
       (6, 'Yes, the group has investigated local resources that may be suitable for a RE project, i.e. available rooftop space, unused fields for wind turbines or readily available bioenergy fuel '),
       (6, 'Yes, the group has looked into grid connection feasibility'),
       (6, 'Yes, the group has consulted with SEC mentors for advice on the matter'),

       (7, 'No'),
       (7, 'Yes, the group has completed the Technology Decision Plan tool to determine the suitable choice of Renewable Energy'),
       (7, 'Yes, the group has investigated local resources that may be suitable for a RE project, i.e. available rooftop space, unused fields for wind turbines or readily available bioenergy fuel'),

       (8, 'No'),
       (8, 'Yes, the group has the support of local authorities such as SEAI'),
       (8, 'Yes, the group has official support from local bodies'),
       (8, 'Yes, agreements have been set up with the local authorities'),
       (8, 'Yes, contacts have been established within the local authorities'),

       (9, 'No'),
       (9, 'Yes, the group has the support of local authorities'),
       (9, 'Yes, the group has official support from local bodies'),
       (9, 'Yes, agreements have been set up with the local authorities'),
       (9, 'Yes, contacts have been established within the local authorities'),

       (10, 'No'),
       (10, 'Yes, with public partners such as SEAI'),
       (10, 'Yes, with private partners (developers)'),
       (10, 'Yes, with SEC mentors'),

       (11, 'No'),
       (11, 'Yes, with public partners'),
       (11, 'Yes, with private partners (developers)'),
       (11, 'Yes, with mentors'),

       (12, 'No'),
       (12, 'It is not completed yet'),
       (12, 'Yes, regarding location and mapping to decide what form of RE is suitable to pursue'),
       (12, 'Yes, regarding local political context'),
       (12, 'Yes, regarding the environmental impact'),
       (12, 'Yes, regarding the impact to the local community'),
       (12, 'Yes, the findings have been shared with the group'),

       (13, 'No'),
       (13, 'It is not completed yet'),
       (13, 'Yes, regarding location and mapping to decide what form of RE is suitable to pursue'),
       (13, 'Yes, regarding local political context'),
       (13, 'Yes, regarding the environmental impact'),
       (13, 'Yes, regarding the impact to the local community'),
       (13, 'Yes, the findings have been shared with the group'),

       (14, 'No'),
       (14, 'No, but options have been presented to the group'),
       (14, 'Yes'),

       (15, 'No'),
       (15, 'Yes, it is in ongoing'),
       (15, 'Yes, the finding were positive and have been shared with the group'),
       (15, 'Yes, but the project is not viable and must be discontinued'),

       (16, 'No'),
       (16, 'Yes, commitment to lease on behalf of the association'),
       (16, 'Yes, commitment to lease on behalf of a local community partner'),

       (17, 'No'),
       (17, 'Yes, a preliminary plan has been established'),
       (17, 'Yes, the financial structure has been agreed'),
       (17, 'Yes, and the group has launched fundraising for development costs'),
       (17, 'Yes, the group is financially mobilized'),

       (18, 'No'),
       (18, 'Yes, they have hosted public meetings'),
       (18, 'Yes, they have hosted technical training sessions'),
       (18, 'Yes, they have hosted financing plan training sessions'),
       (18, 'Yes, they have hosted negotiation training sessions'),
       (18, 'Yes, they have hosted building project management training sessions'),

       (19, 'No'),
       (19, 'Yes, with support from SEC mentors'),
       (19, 'Yes, for quotations'),
       (19, 'Yes, for providers'),
       (19, 'Yes, and a technical study on a risk-sensitive basis and on the level of funds needed'),

       (20, 'No'),
       (20, 'Yes, with support from mentors'),
       (20, 'Yes, for quotations'),
       (20, 'Yes, for providers'),
       (20, 'Yes, and a technical study on a risk-sensitive basis and on the level of funds needed'),

       (21, 'No'),
       (21, 'Yes, from banks'),
       (21, 'Yes, from citizens'),

       (22, 'No'),
       (22, 'Yes, the feed-in tariff has been identified'),
       (22, 'Yes, the technical scenario has been selected'),
       (22, 'Yes, the means of production has been decided'),
       (22, 'Yes, the site has been chosen'),
       (22, 'Yes, the file has been submitted to the authorities for approval'),

       (23, 'No, a public enquiry is going to take place'),
       (23, 'No, the file is being reviewed'),
       (23, 'No, the project is being appealed '),
       (23, 'Yes, there has been administration approval'),

       (24, 'No, it has not been started yet'),
       (24, 'No, but it is in progress'),
       (24, 'No, a feasibility study is ongoing'),
       (24, 'Yes, the financial plan is consolidated'),
       (24, 'Yes, and a risk assessment has been carried out'),
       (24, 'Yes, the banking file is complete'),

       (25, 'No'),
       (25, 'Yes, bank loan'),
       (25, 'Yes, members’ investments'),
       (25, 'Yes, government funding scheme'),

       (26, 'No'),
       (26, 'Yes, the land leasing contracts have been signed'),
       (26, 'Yes, the energy feed-in tariffs have been agreed'),
       (26, 'Yes, materials and production machines have been agreed'),
       (26, 'Yes, maintenance contracts have been agreed'),
       (26, 'Yes, building providers have been agreed'),

       (27, 'No'),
       (27, 'Yes, there has been a session to discuss citizen involvement in project management'),
       (27, 'Yes, an official project management plan has been put in place'),
       (27, 'Yes, there has been a group visit to the construction site'),
       (27, 'Yes, plans are in place for preparation of operation monitoring'),

       (28, 'No'),
       (28, 'Yes, construction had commenced'),
       (28, 'Yes, providers for neighborhood impact monitoring studies have been identified'),
       (28, 'Yes, providers for environmental studies have been identified'),
       (28, 'Yes, providers for system monitoring have been identified'),
       (28, 'Yes, the site has been commissioned'),

       (29, 'No, construction is still ongoing'),
       (29, 'No, but construction is complete and it has been inaugurated'),
       (29, 'Yes, with ongoing communication regarding the operation'),

       (30, 'No'),
       (30, 'Yes, the finances are managed through the committee'),
       (30, 'Yes, profits have been allocated'),

       (31, 'No'),
       (31, 'Yes, neighborhood impact monitoring in the first year of the project'),
       (31, 'Yes, environmental monitoring every year of the project'),
       (31, 'Yes, preventative maintenance and repairs are being carried out regularly'),
       (31, 'Yes, the production site is being continuously technically monitored'),

       (32, 'No'),
       (32, 'Yes, they have hosted a general assembly with the executive board'),
       (32, 'Yes, and compensatory measures have been put in place for citizens'),
       (32, 'Yes, they keep in touch with residents of the project'),

       (33, 'No'),
       (33, 'Yes, about renewable energy'),
       (33, 'Yes, about the environment'),
       (33, 'Yes, about energy saving');

/* */

CREATE TABLE `#__pt_project`
(
    `id`          INT UNSIGNED     NOT NULL AUTO_INCREMENT,
    `user_id`     INT UNSIGNED     NOT NULL, /* TODO: Foreign key of user table */
    `name`        VARCHAR(255)     NOT NULL,
    `description` VARCHAR(255),
    `activated`   TINYINT UNSIGNED NOT NULL DEFAULT '0',
    PRIMARY KEY (`id`)
)
    ENGINE = InnoDB
    AUTO_INCREMENT = 0
    DEFAULT CHARSET = utf8mb4
    DEFAULT COLLATE = utf8mb4_unicode_ci;

/* */

CREATE TABLE `#__pt_project_choice`
(
    `project_id` INT UNSIGNED     NOT NULL,
    `choice_id`  TINYINT UNSIGNED NOT NULL,
    CONSTRAINT id PRIMARY KEY (project_id, choice_id),
    FOREIGN KEY (project_id) REFERENCES `#__pt_project` (id),
    FOREIGN KEY (choice_id) REFERENCES `#__pt_question_choice` (id)
)
    ENGINE = InnoDB
    AUTO_INCREMENT = 0
    DEFAULT CHARSET = utf8mb4
    DEFAULT COLLATE = utf8mb4_unicode_ci;

/* */

CREATE TABLE `#__pt_project_approval`
(
    `project_id`  INT UNSIGNED     NOT NULL,
    `approval_id` TINYINT UNSIGNED NOT NULL,
    CONSTRAINT id PRIMARY KEY (project_id, approval_id),
    FOREIGN KEY (project_id) REFERENCES `#__pt_project` (id),
    FOREIGN KEY (approval_id) REFERENCES `#__pt_approval_question` (id)
)
    ENGINE = InnoDB
    AUTO_INCREMENT = 0
    DEFAULT CHARSET = utf8mb4
    DEFAULT COLLATE = utf8mb4_unicode_ci;