DROP TABLE IF EXISTS `#__pt_choice_task`;
DROP TABLE IF EXISTS `#__pt_project_approval`;
DROP TABLE IF EXISTS `#__pt_project_choice`;
DROP TABLE IF EXISTS `#__pt_question_choice`;
DROP TABLE IF EXISTS `#__pt_question_country`;
DROP TABLE IF EXISTS `#__pt_task_country`;
DROP TABLE IF EXISTS `#__pt_country`;
DROP TABLE IF EXISTS `#__pt_question_icon`;
DROP TABLE IF EXISTS `#__pt_question`;
DROP TABLE IF EXISTS `#__pt_project`;
DROP TABLE IF EXISTS `#__pt_approval_question`;
DROP TABLE IF EXISTS `#__pt_task`;
DROP TABLE IF EXISTS `#__pt_section`;
DROP TABLE IF EXISTS `#__pt_category`;
DROP TABLE IF EXISTS `#__pt_project_type`;

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
       ('Has the group thought about how to finance the project?"'),
       ('Has the group sought advice from other groups, and are they interested to do so?');

/**/

CREATE TABLE `#__pt_category`
(
    `id`                    TINYINT UNSIGNED NOT NULL AUTO_INCREMENT,
    `category`              VARCHAR(255)     NOT NULL,
    `timeline_url_fragment` VARCHAR(255)     NOT NULL,
    `colour_hex`            VARCHAR(7)       NOT NULL DEFAULT ('#ffffff'),
    `colour_rgb`            VARCHAR(13)      NOT NULL DEFAULT ('255, 255, 255'),
    PRIMARY KEY (`id`)
)
    ENGINE = InnoDB
    AUTO_INCREMENT = 0
    DEFAULT CHARSET = utf8mb4
    DEFAULT COLLATE = utf8mb4_unicode_ci;

INSERT INTO `#__pt_category` (`id`, `category`, `timeline_url_fragment`, `colour_hex`, `colour_rgb`)
VALUES (1, 'People', '#group', '#f7a58a', '247, 165, 138'),         -- RED-ORANGE
       (2, 'Technology', '#technical', '#95d0ab', '149, 208, 171'), -- PURPLE
       (3, 'Finance', '#financial', '#9690c6', '150, 144, 198');
-- GREEN

/* */

CREATE TABLE `#__pt_section`
(
    `id`                TINYINT UNSIGNED NOT NULL AUTO_INCREMENT,
    `section`           VARCHAR(255)     NOT NULL,
    `timeline_url_path` VARCHAR(255)     NOT NULL,
    PRIMARY KEY (`id`)
)
    ENGINE = InnoDB
    AUTO_INCREMENT = 0
    DEFAULT CHARSET = utf8mb4
    DEFAULT COLLATE = utf8mb4_unicode_ci;

INSERT INTO `#__pt_section` (`id`, `section`, `timeline_url_path`)
VALUES (1, 'Awareness', 'awareness'),
       (2, 'Emergence', 'emergence'),
       (3, 'Development', 'development'),
       (4, 'Post-Development', 'post-development'),
       (5, 'Construction', 'construction'),
       (6, 'Operation', 'operation');

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
VALUES -- Irish
       (1, 1, 'Has your community hosted awareness activities surrounding the energy transition?'),
       -- Exclude Ireland
       (2, 1, 'Has your community hosted awareness activities surrounding the energy transition?'),
       -- Irish
       (3, 3, 'Has there been exploratory discussions within the community about creating a renewable energy project?'),
       -- Exclude Ireland
       (4, 3, 'Has there been exploratory discussions within the community about creating a renewable energy project?'),
       (5, 1,
        'Has a group been formed to manage the energy transition and any renewable energy projects in your community?'),
       -- Irish
       (6, 2, 'Has this group pursued any informal evaluation of the area to determine suitability?'),
       -- Exclude Ireland
       (7, 2, 'Has this group pursued any informal evaluation of the area to determine suitability?'),
       -- Irish
       (8, 1, 'Do the local authorities know this group? Is the group registered as an SEC with SEAI?'),
       -- Exclude Ireland
       (9, 1, 'Do the local authorities know this group?'),
       -- Irish
       (10, 3, 'Has there been any meetings with potential partners or mentors?'),
       -- Exclude Ireland
       (11, 3, 'Has there been any meetings with potential partners or mentors?'),
       -- Irish
       (12, 2,
        'Has a preliminary evaluation of the territory been completed? Has an Energy Master Plan been carried out for the community?'),
       -- Exclude Ireland
       (13, 2, 'Has a preliminary evaluation of the territory been completed?'),
       (14, 2,
        'Following the preliminary evaluation of the territory, has a decision been made regarding project choice?'),
       (15, 2, 'Has a feasibility study been carried out for the selected Renewable Energy Project?'),
       (16, 2, 'Has a land leasing commitment been agreed?'),
       (17, 3, 'Is there a finance plan agreed within the group?'),
       (18, 1, 'Has the local community group become a project society?'),
       -- Irish
       (19, 2, 'Has a technical committee been established within the group?'),
       -- Exclude Ireland
       (20, 1, 'Has a technical committee been established within the group?'),
       (21, 3, 'Has the group began planning how to raise equity for the project?'),
       (22, 2,
        'Is there a technical file for planning permission to be submitted for administration approval? This file will contain a report from any studies carried out and other documents required by authorities to give planning permission for the project.'),
       (23, 2, 'Was the file approved?'),
       (24, 3, 'Is the financial plan finalized?'),
       (25, 3, 'How will the construction phase of the project be financed?'),
       (26, 2, 'Has the construction contracts been signed?'),
       (27, 1, 'Has a plan for project management been agreed upon?'),
       (28, 2, 'Has construction commenced?'),
       (29, 1, 'Is the site operational?'),
       (30, 3, 'Is there a financial management scheme in place for the project?'),
       (31, 2, 'Is the group partaking in monitoring the project?'),
       (32, 1, 'Has the community group maintained strong bonds with the local citizens?'),
       (33, 1, 'Has there been further educational activities in your community?');

/* */

CREATE TABLE `#__pt_question_icon`
(
    `id`            SMALLINT UNSIGNED NOT NULL AUTO_INCREMENT,
    `question_id`   SMALLINT UNSIGNED NOT NULL,
    `filepath`      VARCHAR(255)      NOT NULL,
    `width`         SMALLINT UNSIGNED NOT NULL DEFAULT 0,
    `height`        SMALLINT UNSIGNED NOT NULL DEFAULT 0,
    `right_offset`  SMALLINT UNSIGNED NOT NULL DEFAULT 0,
    `bottom_offset` SMALLINT UNSIGNED NOT NULL DEFAULT 0,
    PRIMARY KEY (`id`),
    FOREIGN KEY (`question_id`) REFERENCES `#__pt_question` (id)
)
    ENGINE = InnoDB
    AUTO_INCREMENT = 0
    DEFAULT CHARSET = utf8mb4
    DEFAULT COLLATE = utf8mb4_unicode_ci;

INSERT INTO `#__pt_question_icon` (`question_id`, `filepath`, `width`, `height`, `right_offset`, `bottom_offset`)
VALUES (1, '/media/com_progresstool/icons/Illustrations_Reflexions.jpg', 250, 169, 32, 59),
       (2, '/media/com_progresstool/icons/Illustrations_Reflexions.jpg', 250, 169, 32, 59),
       (3, '/media/com_progresstool/icons/Illustrations_Formations.jpg', 225, 168, 40, 30),
       (4, '/media/com_progresstool/icons/Illustrations_Formations.jpg', 225, 168, 40, 30),
       (5, '/media/com_progresstool/icons/Illustrations_Lien.jpg', 200, 177, 50, 8),
       (8, '/media/com_progresstool/icons/Illustrations_MobilisationFinance.jpg', 250, 180, 35, 20),
       (9, '/media/com_progresstool/icons/Illustrations_MobilisationFinance.jpg', 250, 180, 35, 20),
       (10, '/media/com_progresstool/icons/Illustrations_Inauguration.jpg', 368, 175, 70, 55),
       (11, '/media/com_progresstool/icons/Illustrations_Inauguration.jpg', 368, 175, 70, 55),
       (12, '/media/com_progresstool/icons/Illustrations_Compta.jpg', 250, 250, 45, 5),
       (13, '/media/com_progresstool/icons/Illustrations_Compta.jpg', 250, 250, 45, 5),
       (14, '/media/com_progresstool/icons/Illustrations_Compta.jpg', 200, 200, 65, 5),
       (15, '/media/com_progresstool/icons/Illustrations_Administratif.jpg', 155, 151, 75, 55),
       (16, '/media/com_progresstool/icons/Illustrations_Chantier.jpg', 284, 150, 32, 57),
       (17, '/media/com_progresstool/icons/Illustrations_MobilisationFinance.jpg', 265, 189, 30, 123),
       (18, '/media/com_progresstool/icons/Illustrations_InitiativesLocale02.jpg', 235, 197, 58, 166),
       (20, '/media/com_progresstool/icons/Illustrations_Inauguration.jpg', 350, 167, 60, 115),
       (21, '/media/com_progresstool/icons/Illustrations_Chantier.jpg', 312, 165, 55, 43),
       (22, '/media/com_progresstool/icons/Illustrations_Compta.jpg', 215, 215, 50, 65),
       (23, '/media/com_progresstool/icons/Illustrations_PouceOK.jpg', 113, 113, 100, 75),
       (24, '/media/com_progresstool/icons/Illustrations_MobilisationFinance.jpg', 265, 191, 90, 75),
       (25, '/media/com_progresstool/icons/Illustrations_Banque.jpg', 375, 173, 55, 56),
       (26, '/media/com_progresstool/icons/Illustrations_VisiteChantier.jpg', 400, 198, 46, 4),
       (27, '/media/com_progresstool/icons/Illustrations_Management.jpg', 200, 213, 25, 13),
       (28, '/media/com_progresstool/icons/Illustrations_Chantier.jpg', 365, 193, 29, 20),
       (29, '/media/com_progresstool/icons/Illustrations_VisiteChantier.jpg', 375, 186, 14, 16),
       (30, '/media/com_progresstool/icons/Illustrations_Argent01.jpg', 150, 169, 65, 15),
       (31, '/media/com_progresstool/icons/Illustrations_Formations.jpg', 245, 182, 50, 50),
       (32, '/media/com_progresstool/icons/Illustrations_Lien.jpg', 175, 155, 35, 0),
       (33, '/media/com_progresstool/icons/Illustrations_AvionPapier.jpg', 350, 262, 0, 0);

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
VALUES (2, 1),
       (4, 1),
       (5, 1),
       (7, 1),
       (9, 1),
       (11, 1),
       (13, 1),
       (14, 1),
       (15, 1),
       (16, 1),
       (17, 1),
       (18, 1),
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
       (33, 1),
       (1, 2),
       (3, 2),
       (5, 2),
       (6, 2),
       (8, 2),
       (10, 2),
       (12, 2),
       (14, 2),
       (15, 2),
       (16, 2),
       (17, 2),
       (18, 2),
       (19, 2),
       (21, 2),
       (22, 2),
       (23, 2),
       (24, 2),
       (25, 2),
       (26, 2),
       (27, 2),
       (28, 2),
       (29, 2),
       (30, 2),
       (31, 2),
       (32, 2),
       (33, 2);

/* */

CREATE TABLE `#__pt_question_choice` /* TODO: Make question_id, choice_id a composite primary key, must conduct tests */
(
    `id`          SMALLINT UNSIGNED NOT NULL AUTO_INCREMENT,
    `question_id` SMALLINT UNSIGNED NOT NULL,
    `choice`      VARCHAR(255)      NOT NULL DEFAULT 'blank choice',
    `weight`      TINYINT UNSIGNED  NOT NULL DEFAULT '1',
    PRIMARY KEY (`id`),
    FOREIGN KEY (question_id) REFERENCES `#__pt_question` (id)
)
    ENGINE = InnoDB
    AUTO_INCREMENT = 0
    DEFAULT CHARSET = utf8mb4
    DEFAULT COLLATE = utf8mb4_unicode_ci;

INSERT INTO `#__pt_question_choice` (`id`, `question_id`, `choice`, `weight`)
VALUES -- Question 1
       (1, 1, 'No', 0),
       (2, 1, 'Yes, about existing beacons in ECCO and other Irish community group projects', 1),
       (3, 1, 'Yes, about the actions of local authorities and their role in the transition', 1),
       (4, 1, 'Yes, there has been local initiatives about coming up with new ideas', 1),

       -- Question 2
       (5, 2, 'No', 0),
       (6, 2, 'Yes, about existing beacons in ECCO', 1),
       (7, 2, 'Yes, about the actions of local authorities and their role in the transition', 1),
       (8, 2, 'Yes, there has been local initiatives about coming up with new ideas', 1),

       -- Question 3
       (9, 3, 'No', 0),
       (10, 3,
        'Yes, regarding the type of governance that would be involved e.g. Co-operative or Sustainable Energy Community with SEAI (SEC)',
        1),
       (11, 3, 'Yes, regarding the financial structuring', 1),
       (12, 3, 'Yes, regarding the type of partnerships available and if they would be suitable', 1),
       (13, 3, 'Yes, regarding how to distribute benefits and profits among the local area', 1),

       -- Question 4
       (14, 4, 'No', 0),
       (15, 4, 'Yes, regarding the type of governance that would be involved e.g. Co-operative', 1),
       (16, 4, 'Yes, regarding the financial structuring', 1),
       (17, 4, 'Yes, regarding the type of partnerships available and if they would be suitable', 1),
       (18, 4, 'Yes, regarding how to distribute benefits and profits among the local area', 1),

       -- Question 5
       (19, 5, 'No', 0),
       (20, 5, 'No, but there is interest from the community to forms one', 0),
       (21, 5,
        'Yes, there is a leading group that has been democratically organized and formed with members of the local community',
        1),
       (22, 5, 'Yes, legal, technical and financial structuring has been discussed ', 1),
       (23, 5, 'Yes, the goals and the values of the group have been outlined', 1),
       (24, 5, 'Yes, the group has been officially founded as an association', 1),

       -- Question 6
       (25, 6, 'No', 0),
       (26, 6,
        'Yes, the group has completed the Technology Decision Plan tool to determine the suitable choice of Renewable Energy',
        1),
       (27, 6,
        'Yes, the group has investigated local resources that may be suitable for a RE project, i.e. available rooftop space, unused fields for wind turbines or readily available bioenergy fuel',
        1),
       (28, 6, 'Yes, the group has looked into grid connection feasibility', 1),
       (29, 6, 'Yes, the group has consulted with SEC mentors for advice on the matter', 1),

       -- Question 7
       (30, 7, 'No', 0),
       (31, 7,
        'Yes, the group has completed the Technology Decision Plan tool to determine the suitable choice of Renewable Energy',
        1),
       (32, 7,
        'Yes, the group has investigated local resources that may be suitable for a RE project, i.e. available rooftop space, unused fields for wind turbines or readily available bioenergy fuel',
        1),

       -- Question 8
       (33, 8, 'No', 0),
       (34, 8, 'Yes, the group has the support of local authorities such as SEAI', 1),
       (35, 8, 'Yes, the group has official support from local bodies', 1),
       (36, 8, 'Yes, agreements have been set up with the local authorities', 1),
       (37, 8, 'Yes, contacts have been established within the local authorities', 1),

       -- Question 9
       (38, 9, 'No', 0),
       (39, 9, 'Yes, the group has the support of local authorities', 1),
       (40, 9, 'Yes, the group has official support from local bodies', 1),
       (41, 9, 'Yes, agreements have been set up with the local authorities', 1),
       (42, 9, 'Yes, contacts have been established within the local authorities', 1),

       -- Question 10
       (43, 10, 'No', 0),
       (44, 10, 'Yes, with public partners such as SEAI', 1),
       (45, 10, 'Yes, with private partners (developers)', 1),
       (46, 10, 'Yes, with SEC mentors', 1),

       -- Question 11
       (47, 11, 'No', 0),
       (48, 11, 'Yes, with public partners', 1),
       (49, 11, 'Yes, with private partners (developers)', 1),
       (50, 11, 'Yes, with mentors', 1),

       -- Question 12
       (51, 12, 'No', 0),
       (52, 12, 'It is not completed yet', 0),
       (53, 12, 'Yes, regarding location and mapping to decide what forms of RE is suitable to pursue', 1),
       (54, 12, 'Yes, regarding local political context', 1),
       (55, 12, 'Yes, regarding the environmental impact', 1),
       (56, 12, 'Yes, regarding the impact to the local community', 1),
       (57, 12, 'Yes, the findings have been shared with the group', 1),

       -- Question 13
       (58, 13, 'No', 0),
       (59, 13, 'It is not completed yet', 0),
       (60, 13, 'Yes, regarding location and mapping to decide what forms of RE is suitable to pursue', 1),
       (61, 13, 'Yes, regarding local political context', 1),
       (62, 13, 'Yes, regarding the environmental impact', 1),
       (63, 13, 'Yes, regarding the impact to the local community', 1),
       (64, 13, 'Yes, the findings have been shared with the group', 1),

       -- Question 14
       (65, 14, 'No', 0),
       (66, 14, 'No, but options have been presented to the group', 0),
       (67, 14, 'Yes', 2),

       -- Question 15
       (68, 15, 'No', 0),
       (69, 15, 'Yes, it is in ongoing', 1),
       (70, 15, 'Yes, the finding were positive and have been shared with the group', 1),
       (71, 15, 'Yes, but the project is not viable and must be discontinued', 1),

       -- Question 16
       (72, 16, 'No', 0),
       (73, 16, 'Yes, commitment to lease on behalf of the association', 2),
       (74, 16, 'Yes, commitment to lease on behalf of a local community partner', 2),

       -- Question 17
       (75, 17, 'No', 0),
       (76, 17, 'Yes, a preliminary plan has been established', 1),
       (77, 17, 'Yes, the financial structure has been agreed', 1),
       (78, 17, 'Yes, and the group has launched fundraising for development costs', 1),
       (79, 17, 'Yes, the group is financially mobilized', 1),

       -- Question 18
       (80, 18, 'No', 0),
       (81, 18, 'Yes, they have hosted public meetings', 1),
       (82, 18, 'Yes, they have hosted technical training sessions', 1),
       (83, 18, 'Yes, they have hosted financing plan training sessions', 1),
       (84, 18, 'Yes, they have hosted negotiation training sessions', 1),
       (85, 18, 'Yes, they have hosted building project management training sessions', 1),

       -- Question 19
       (86, 19, 'No', 0),
       (87, 19, 'Yes, with support from SEC mentors', 1),
       (88, 19, 'Yes, for quotations', 1),
       (89, 19, 'Yes, for providers', 1),
       (90, 19, 'Yes, and a technical study on a risk-sensitive basis and on the level of funds needed', 1),

       -- Question 20
       (91, 20, 'No', 0),
       (92, 20, 'Yes, with support from mentors', 1),
       (93, 20, 'Yes, for quotations', 1),
       (94, 20, 'Yes, for providers', 1),
       (95, 20, 'Yes, and a technical study on a risk-sensitive basis and on the level of funds needed', 1),

       -- Question 21
       (96, 21, 'No', 0),
       (97, 21, 'Yes, from banks', 1),
       (98, 21, 'Yes, from citizens', 1),

       -- Question 22
       (99, 22, 'No', 0),
       (100, 22, 'Yes, the feed-in tariff has been identified', 1),
       (101, 22, 'Yes, the technical scenario has been selected', 1),
       (102, 22, 'Yes, the means of production has been decided', 1),
       (103, 22, 'Yes, the site has been chosen', 1),
       (104, 22, 'Yes, the file has been submitted to the authorities for approval', 1),

       -- Question 23
       (105, 23, 'No, a public enquiry is going to take place', 0),
       (106, 23, 'No, the file is being reviewed', 0),
       (107, 23, 'No, the project is being appealed ', 0),
       (108, 23, 'Yes, there has been administration approval', 3),

       -- Question 24
       (109, 24, 'No, it has not been started yet', 0),
       (110, 24, 'No, but it is in progress', 0),
       (111, 24, 'No, a feasibility study is ongoing', 0),
       (112, 24, 'Yes, the financial plan is consolidated', 1),
       (113, 24, 'Yes, and a risk assessment has been carried out', 1),
       (114, 24, 'Yes, the banking file is complete', 1),

       -- Question 25
       (115, 25, 'No', 0),
       (116, 25, 'Yes, bank loan', 1),
       (117, 25, 'Yes, members’ investments', 1),
       (118, 25, 'Yes, government funding scheme', 1),

       -- Question 26
       (119, 26, 'No', 0),
       (120, 26, 'Yes, the land leasing contracts have been signed', 1),
       (121, 26, 'Yes, the energy feed-in tariffs have been agreed', 1),
       (122, 26, 'Yes, materials and production machines have been agreed', 1),
       (123, 26, 'Yes, maintenance contracts have been agreed', 1),
       (124, 26, 'Yes, building providers have been agreed', 1),

       -- Question 27
       (125, 27, 'No', 0),
       (126, 27, 'Yes, there has been a session to discuss citizen involvement in project management', 1),
       (127, 27, 'Yes, an official project management plan has been put in place', 1),
       (128, 27, 'Yes, there has been a group visit to the construction site', 1),
       (129, 27, 'Yes, plans are in place for preparation of operation monitoring', 1),

       -- Question 28
       (130, 28, 'No', 0),
       (131, 28, 'Yes, construction had commenced', 1),
       (132, 28, 'Yes, providers for neighborhood impact monitoring studies have been identified', 1),
       (133, 28, 'Yes, providers for environmental studies have been identified', 1),
       (134, 28, 'Yes, providers for system monitoring have been identified', 1),
       (135, 28, 'Yes, the site has been commissioned', 1),

       -- Question 29
       (136, 29, 'No, construction is still ongoing', 0),
       (137, 29, 'No, but construction is complete and it has been inaugurated', 0),
       (138, 29, 'Yes, with ongoing communication regarding the operation', 3),

       -- Question 30
       (139, 30, 'No', 0),
       (140, 30, 'Yes, the finances are managed through the committee', 1),
       (141, 30, 'Yes, profits have been allocated', 1),

       -- Question 31
       (142, 31, 'No', 0),
       (143, 31, 'Yes, neighborhood impact monitoring in the first year of the project', 1),
       (144, 31, 'Yes, environmental monitoring every year of the project', 1),
       (145, 31, 'Yes, preventative maintenance and repairs are being carried out regularly', 1),
       (146, 31, 'Yes, the production site is being continuously technically monitored', 1),

       -- Question 32
       (147, 32, 'No', 0),
       (148, 32, 'Yes, they have hosted a general assembly with the executive board', 1),
       (149, 32, 'Yes, and compensatory measures have been put in place for citizens', 1),
       (150, 32, 'Yes, they keep in touch with residents of the project', 1),

       -- Question 33
       (151, 33, 'No', 0),
       (152, 33, 'Yes, about renewable energy', 1),
       (153, 33, 'Yes, about the environment', 1),
       (154, 33, 'Yes, about energy saving', 1);

/* */

CREATE TABLE `#__pt_project_type`
(
    `id`   TINYINT UNSIGNED NOT NULL AUTO_INCREMENT,
    `type` VARCHAR(50)      NOT NULL,
    PRIMARY KEY (`id`)
)
    ENGINE = InnoDB
    AUTO_INCREMENT = 0
    DEFAULT CHARSET = utf8mb4
    DEFAULT COLLATE = utf8mb4_unicode_ci;

INSERT INTO `#__pt_project_type` (`type`)
VALUES ('Solar'),
       ('Wind'),
       ('Hydro'),
       ('Biomass');

/* */

CREATE TABLE `#__pt_project`
(
    `id`                  INT UNSIGNED     NOT NULL AUTO_INCREMENT,
    `user_id`             INT UNSIGNED     NOT NULL,             -- TODO: Foreign key of user table?
    `group_id`            INT UNSIGNED     NOT NULL DEFAULT '0', -- TODO: Foreign key of community_groups?
    `name`                VARCHAR(100)     NOT NULL,
    `description`         VARCHAR(255),
    `type_id`             TINYINT UNSIGNED NOT NULL,
    `creation_date`       TIMESTAMP        NOT NULL,
    `activated`           TINYINT UNSIGNED NOT NULL DEFAULT '0',
    `deactivated`         TINYINT UNSIGNED NOT NULL DEFAULT '0',
    `deactivation_reason` VARCHAR(255),
    PRIMARY KEY (`id`),
    FOREIGN KEY (`type_id`) REFERENCES `#__pt_project_type` (`id`)
)
    ENGINE = InnoDB
    AUTO_INCREMENT = 0
    DEFAULT CHARSET = utf8mb4
    DEFAULT COLLATE = utf8mb4_unicode_ci;

/* */

CREATE TABLE `#__pt_project_choice`
(
    `project_id` INT UNSIGNED      NOT NULL,
    `choice_id`  SMALLINT UNSIGNED NOT NULL,
    CONSTRAINT id PRIMARY KEY (project_id, choice_id),
    FOREIGN KEY (project_id) REFERENCES `#__pt_project` (id) ON DELETE CASCADE,
    FOREIGN KEY (choice_id) REFERENCES `#__pt_question_choice` (id) ON DELETE CASCADE
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
    FOREIGN KEY (project_id) REFERENCES `#__pt_project` (id) ON DELETE CASCADE,
    FOREIGN KEY (approval_id) REFERENCES `#__pt_approval_question` (id)
)
    ENGINE = InnoDB
    AUTO_INCREMENT = 0
    DEFAULT CHARSET = utf8mb4
    DEFAULT COLLATE = utf8mb4_unicode_ci;

/* */

CREATE TABLE `#__pt_task`
(
    `id`          SMALLINT UNSIGNED NOT NULL AUTO_INCREMENT,
    `category_id` TINYINT UNSIGNED  NOT NULL,
    `section_id`  TINYINT UNSIGNED  NOT NULL,
    `task`        VARCHAR(255)      NOT NULL,
    CONSTRAINT id PRIMARY KEY (id),
    FOREIGN KEY (category_id) REFERENCES `#__pt_category` (id),
    FOREIGN KEY (section_id) REFERENCES `#__pt_section` (id)
)
    ENGINE = InnoDB
    AUTO_INCREMENT = 0
    DEFAULT CHARSET = utf8mb4
    DEFAULT COLLATE = utf8mb4_unicode_ci;

INSERT INTO `#__pt_task` (`id`, `category_id`, `section_id`, `task`)
VALUES (1, 1, 1,
        'Awareness activities about existing Beacon projects, Educational actions of local associations, Private developer prospection'),
       (2, 1, 1,
        'Local initiatives: new ideas + willpower of individuals, citizens, associations and local communities'),
       (3, 1, 1, 'Leading group'),
       (4, 1, 2,
        'Masterclasses: democratic organisation of the citizen group, Legal structuring, Technical issues, Initial financial elements, Expansion of the citizen group'),
       (5, 1, 2,
        'Brainwork on: goals and values of the group, The type of energy and awareness actions around energy transition'),
       (6, 1, 2, 'Organisation of the group, Founding of the association'),
       (7, 1, 2, 'Support of local authorities, to obtain official support from local bodies'),
       (8, 1, 3, 'Founding of the project society'),
       (9, 1, 3,
        'Public meetings and Advanced training: technical training, financing plan, negotiation training, building project management'),
       (10, 1, 3, 'Setting up of agreements with local authorities'),
       (11, 1, 3, 'Establish contacts with administrative authorities'),
       -- (12, 1, 'Citizen financial mobilisation'),
       (13, 1, 4, 'Brainwork on the citizen involvement in project management'),
       (14, 1, 5, 'Project management'),
       (15, 1, 5, 'Work site visit'),
       (16, 1, 5, 'Preparation for the operation monitoring'),
       (17, 1, 5, 'Inauguration'),
       (18, 1, 6, 'Ongoing communication on operation'),
       (19, 1, 6,
        'Management of the cooperative: general assembly, executive board, retain strong bonds with citizens, compensatory measure'),
       (20, 1, 6, 'Keep in touch with the residents of the project'),
       (21, 1, 6, 'Educational activities on: renewable energy, environmental effects, Energy savings'),

       (22, 2, 2, 'Preliminary evaluation of the territory'),
       (23, 2, 2, 'Project choice'),
       (24, 2, 2, 'Land leasing commitment'),
       (25, 2, 3, 'Ongoing analysis and validation: Technical committee, quotations, providers'),
       (26, 2, 3, 'Technical Studies on a risk-sensitive basis and on the level of funds needed'),
       (27, 2, 3, 'Technical file for submission for administrative approval'),
       (28, 2, 3, 'Submission of the file to approval of authorities'),
       (29, 2, 3, 'Public enquiry / review of the file'),
       (30, 2, 3, 'Administration approval'),
       (31, 2, 4, 'Land leasing contracts'),
       (32, 2, 4, 'Signing of the construction contracts'),
       (33, 2, 5, 'Construction Site'),
       (34, 2, 5, 'Commissioning'),
       (35, 2, 6, 'Environmental monitoring'),
       (36, 2, 6, 'Preventative maintenance and repairs'),

       (37, 3, 2,
        'Think thank: type of governance, financial structuring, types of partnerships, how to distribute the benefits'),
       (38, 3, 2, 'Meeting with potential partner'),
       (39, 3, 2, 'Preliminary financing plan'),
       (40, 3, 3,
        'Financial mobilisation, launch fundraising for development costs, reinforcement of funding partnerships'),
       (41, 3, 3, 'Preparation of the financial mobilisation for the construction phase'),
       (42, 3, 3, 'Consolidation of the financial plan'),
       (43, 3, 3, 'Assessment of the valuation of the risk'),
       (44, 3, 4, 'Completion of the banking file'),
       (45, 3, 4, 'Fundraising and bank loan for the construction phase'),
       (46, 3, 6, 'Financial management accounting'),
       (47, 3, 6, 'Profit allocation management');

/* */

CREATE TABLE `#__pt_task_country`
(
    `task_id`    SMALLINT UNSIGNED NOT NULL,
    `country_id` TINYINT UNSIGNED  NOT NULL,
    `criteria`   TINYINT UNSIGNED  NOT NULL,
    `logic_id`   TINYINT UNSIGNED  NOT NULL DEFAULT 0,
    CONSTRAINT id PRIMARY KEY (`task_id`, `country_id`),
    FOREIGN KEY (`task_id`) REFERENCES `#__pt_task` (`id`),
    FOREIGN KEY (`country_id`) REFERENCES `#__pt_country` (`id`)
)
    ENGINE = InnoDB
    AUTO_INCREMENT = 0
    DEFAULT CHARSET = utf8mb4
    DEFAULT COLLATE = utf8mb4_unicode_ci;

INSERT INTO `#__pt_task_country` (`task_id`, `country_id`, `criteria`, `logic_id`)
VALUES (1, 1, 1, 0),
       (2, 1, 1, 0),
       (3, 1, 1, 0),
       (4, 1, 2, 1),
       (5, 1, 1, 0),
       (6, 1, 1, 0),
       (7, 1, 1, 0),
       (8, 1, 1, 0),
       (9, 1, 5, 1),
       (10, 1, 1, 0),
       (11, 1, 1, 0),
       (13, 1, 1, 0),
       (14, 1, 1, 0),
       (15, 1, 1, 0),
       (16, 1, 1, 0),
       (17, 1, 1, 0),
       (18, 1, 1, 0),
       (19, 1, 2, 1),
       (20, 1, 1, 0),
       (21, 1, 3, 1),
       (22, 1, 4, 1),
       (23, 1, 1, 0),
       (24, 1, 1, 0),
       (25, 1, 3, 1),
       (26, 1, 1, 0),
       (27, 1, 4, 1),
       (28, 1, 1, 0),
       (29, 1, 1, 0),
       (30, 1, 1, 0),
       (31, 1, 1, 0),
       (32, 1, 4, 1),
       (33, 1, 3, 1),
       (34, 1, 1, 0),
       (35, 1, 2, 1),
       (36, 1, 2, 1),
       (37, 1, 4, 1),
       (38, 1, 1, 0),
       (39, 1, 1, 0),
       (40, 1, 3, 1),
       (41, 1, 1, 0),
       (42, 1, 1, 0),
       (43, 1, 1, 0),
       (44, 1, 1, 0),
       (45, 1, 1, 0),
       (46, 1, 1, 0),
       (47, 1, 1, 0),

       (1, 2, 1),
       (2, 2, 1),
       (3, 2, 1),
       (4, 2, 2),
       (5, 2, 1),
       (6, 2, 1),
       (7, 2, 1),
       (8, 2, 1),
       (9, 2, 5),
       (10, 2, 1),
       (11, 2, 1),
       (13, 2, 1),
       (14, 2, 1),
       (15, 2, 1),
       (16, 2, 1),
       (17, 2, 1),
       (18, 2, 1),
       (19, 2, 2),
       (20, 2, 1),
       (21, 2, 3),
       (22, 2, 4),
       (23, 2, 1),
       (24, 2, 1),
       (25, 2, 3),
       (26, 2, 1),
       (27, 2, 4),
       (28, 2, 1),
       (29, 2, 1),
       (30, 2, 1),
       (31, 2, 1),
       (32, 2, 4),
       (33, 2, 3),
       (34, 2, 1),
       (35, 2, 2),
       (36, 2, 2),
       (37, 2, 4),
       (38, 2, 1),
       (39, 2, 1),
       (40, 2, 3),
       (41, 2, 1),
       (42, 2, 1),
       (43, 2, 1),
       (44, 2, 1),
       (45, 2, 1),
       (46, 2, 1),
       (47, 2, 1);

/* */

CREATE TABLE `#__pt_choice_task`
(
    `task_id`   SMALLINT UNSIGNED NOT NULL,
    `choice_id` SMALLINT UNSIGNED NOT NULL,
    CONSTRAINT id PRIMARY KEY (`task_id`, `choice_id`),
    FOREIGN KEY (`task_id`) REFERENCES `#__pt_task` (`id`),
    FOREIGN KEY (`choice_id`) REFERENCES `#__pt_question_choice` (`id`) ON DELETE CASCADE
)
    ENGINE = InnoDB
    AUTO_INCREMENT = 0
    DEFAULT CHARSET = utf8mb4
    DEFAULT COLLATE = utf8mb4_unicode_ci;

INSERT INTO `#__pt_choice_task`(`task_id`, `choice_id`)
VALUES (1, 2),
       (1, 3),
       (1, 6),
       (1, 7),
       (2, 4),
       (2, 8),
       (3, 21),
       (4, 21),
       (4, 22),
       (5, 23),
       (6, 24),
       (7, 34),
       (7, 35),
       (7, 39),
       (7, 40),
       (8, 81),
       (9, 81),
       (9, 82),
       (9, 83),
       (9, 84),
       (9, 85),
       (10, 36),
       (10, 41),
       (11, 37),
       (11, 42),
       -- discarded
       (13, 126),
       (14, 127),
       (15, 128),
       (16, 129),
       (17, 137),
       (18, 138),
       (19, 148),
       (19, 149),
       (20, 150),
       (21, 152),
       (21, 153),
       (21, 154),
       --
       (22, 53),
       (22, 54),
       (22, 55),
       (22, 56),
       (22, 60),
       (22, 61),
       (22, 62),
       (22, 63),
       (23, 67),
       (24, 73),
       (24, 74),
       (25, 87),
       (25, 88),
       (25, 89),
       (26, 90),
       (27, 100),
       (27, 101),
       (27, 102),
       (27, 103),
       (28, 104),
       (29, 105),
       (29, 106),
       (30, 108),
       (31, 120),
       (32, 121),
       (32, 122),
       (32, 123),
       (32, 124),
       (33, 132),
       (33, 133),
       (33, 134),
       (34, 135),
       (35, 143),
       (35, 144),
       (36, 145),
       (36, 146),
       --
       (37, 10),
       (37, 11),
       (37, 12),
       (37, 13),
       (37, 15),
       (37, 16),
       (37, 17),
       (37, 18),
       (38, 44),
       (38, 45),
       (38, 46),
       (38, 48),
       (38, 49),
       (38, 50),
       (39, 76),
       (40, 77),
       (40, 78),
       (40, 79),
       (41, 97),
       (41, 98),
       (42, 112),
       (43, 113),
       (44, 114),
       (45, 116),
       (45, 117),
       (45, 118),
       (46, 140),
       (47, 141);
