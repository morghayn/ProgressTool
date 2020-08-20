DROP TABLE IF EXISTS `#__pt_project_approval`;
DROP TABLE IF EXISTS `#__pt_project_choice`;
DROP TABLE IF EXISTS `#__pt_question_choice`;
DROP TABLE IF EXISTS `#__pt_question_country`;
DROP TABLE IF EXISTS `#__pt_exclude`;
DROP TABLE IF EXISTS `#__pt_country`;
DROP TABLE IF EXISTS `#__pt_question`;
DROP TABLE IF EXISTS `#__pt_project`;
DROP TABLE IF EXISTS `#__pt_approval_question`;
DROP TABLE IF EXISTS `#__pt_progress_goal`;
DROP TABLE IF EXISTS `#__pt_category`;
DROP TABLE IF EXISTS `#__pt_measurement`;
DROP TABLE IF EXISTS `#__pt_measurement_category`;

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
       (3, 'Technology', '#95d0ab', '149, 208, 171');
/* GREEN */
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
       ('Ireland'),
       ('Belgium'),
       ('Germany'),
       ('Netherlands'),
       ('France'),
       ('United Kingdom');

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

INSERT INTO `#__pt_question_choice` (`question_id`, `choice`, `weight`)
VALUES (1, 'No', 0),
       (1, 'Yes, about existing beacons in ECCO and other Irish community group projects', 1),
       (1, 'Yes, about the actions of local authorities and their role in the transition', 1),
       (1, 'Yes, there has been local initiatives about coming up with new ideas', 1),

       (2, 'No', 0),
       (2, 'Yes, about existing beacons in ECCO', 1),
       (2, 'Yes, about the actions of local authorities and their role in the transition', 1),
       (2, 'Yes, there has been local initiatives about coming up with new ideas', 1),

       (3, 'No', 0),
       (3, 'Yes, regarding the type of governance that would be involved e.g. Co-operative or Sustainable Energy Community with SEAI (SEC)', 1),
       (3, 'Yes, regarding the financial structuring', 1),
       (3, 'Yes, regarding the type of partnerships available and if they would be suitable', 1),
       (3, 'Yes, regarding how to distribute benefits and profits among the local area', 1),

       (4, 'No', 0),
       (4, 'Yes, regarding the type of governance that would be involved e.g. Co-operative', 1),
       (4, 'Yes, regarding the financial structuring', 1),
       (4, 'Yes, regarding the type of partnerships available and if they would be suitable', 1),
       (4, 'Yes, regarding how to distribute benefits and profits among the local area', 1),

       (5, 'No', 0),
       (5, 'No, but there is interest from the community to form one', 0),
       (5, 'Yes, there is a leading group that has been democratically organized and formed with members of the local community', 1),
       (5, 'Yes, legal, technical and financial structuring has been discussed ', 1),
       (5, 'Yes, the goals and the values of the group have been outlined', 1),
       (5, 'Yes, the group has been officially founded as an association', 1),

       (6, 'No', 0),
       (6, 'Yes, the group has completed the Technology Decision Plan tool to determine the suitable choice of Renewable Energy', 1),
       (6,
        'Yes, the group has investigated local resources that may be suitable for a RE project, i.e. available rooftop space, unused fields for wind turbines or readily available bioenergy fuel',
        1),
       (6, 'Yes, the group has looked into grid connection feasibility', 1),
       (6, 'Yes, the group has consulted with SEC mentors for advice on the matter', 1),

       (7, 'No', 0),
       (7, 'Yes, the group has completed the Technology Decision Plan tool to determine the suitable choice of Renewable Energy', 1),
       (7,
        'Yes, the group has investigated local resources that may be suitable for a RE project, i.e. available rooftop space, unused fields for wind turbines or readily available bioenergy fuel',
        1),

       (8, 'No', 0),
       (8, 'Yes, the group has the support of local authorities such as SEAI', 1),
       (8, 'Yes, the group has official support from local bodies', 1),
       (8, 'Yes, agreements have been set up with the local authorities', 1),
       (8, 'Yes, contacts have been established within the local authorities', 1),

       (9, 'No', 0),
       (9, 'Yes, the group has the support of local authorities', 1),
       (9, 'Yes, the group has official support from local bodies', 1),
       (9, 'Yes, agreements have been set up with the local authorities', 1),
       (9, 'Yes, contacts have been established within the local authorities', 1),

       (10, 'No', 0),
       (10, 'Yes, with public partners such as SEAI', 1),
       (10, 'Yes, with private partners (developers)', 1),
       (10, 'Yes, with SEC mentors', 1),

       (11, 'No', 0),
       (11, 'Yes, with public partners', 1),
       (11, 'Yes, with private partners (developers)', 1),
       (11, 'Yes, with mentors', 1),

       (12, 'No', 0),
       (12, 'It is not completed yet', 0),
       (12, 'Yes, regarding location and mapping to decide what form of RE is suitable to pursue', 1),
       (12, 'Yes, regarding local political context', 1),
       (12, 'Yes, regarding the environmental impact', 1),
       (12, 'Yes, regarding the impact to the local community', 1),
       (12, 'Yes, the findings have been shared with the group', 1),

       (13, 'No', 0),
       (13, 'It is not completed yet', 1),
       (13, 'Yes, regarding location and mapping to decide what form of RE is suitable to pursue', 1),
       (13, 'Yes, regarding local political context', 1),
       (13, 'Yes, regarding the environmental impact', 1),
       (13, 'Yes, regarding the impact to the local community', 1),
       (13, 'Yes, the findings have been shared with the group', 1),

       (14, 'No', 0),
       (14, 'No, but options have been presented to the group', 0),
       (14, 'Yes', 2),

       (15, 'No', 0),
       (15, 'Yes, it is in ongoing', 1),
       (15, 'Yes, the finding were positive and have been shared with the group', 1),
       (15, 'Yes, but the project is not viable and must be discontinued', 1),

       (16, 'No', 0),
       (16, 'Yes, commitment to lease on behalf of the association', 2),
       (16, 'Yes, commitment to lease on behalf of a local community partner', 2),

       (17, 'No', 0),
       (17, 'Yes, a preliminary plan has been established', 1),
       (17, 'Yes, the financial structure has been agreed', 1),
       (17, 'Yes, and the group has launched fundraising for development costs', 1),
       (17, 'Yes, the group is financially mobilized', 1),

       (18, 'No', 0),
       (18, 'Yes, they have hosted public meetings', 1),
       (18, 'Yes, they have hosted technical training sessions', 1),
       (18, 'Yes, they have hosted financing plan training sessions', 1),
       (18, 'Yes, they have hosted negotiation training sessions', 1),
       (18, 'Yes, they have hosted building project management training sessions', 1),

       (19, 'No', 0),
       (19, 'Yes, with support from SEC mentors', 1),
       (19, 'Yes, for quotations', 1),
       (19, 'Yes, for providers', 1),
       (19, 'Yes, and a technical study on a risk-sensitive basis and on the level of funds needed', 1),

       (20, 'No', 0),
       (20, 'Yes, with support from mentors', 1),
       (20, 'Yes, for quotations', 1),
       (20, 'Yes, for providers', 1),
       (20, 'Yes, and a technical study on a risk-sensitive basis and on the level of funds needed', 1),

       (21, 'No', 0),
       (21, 'Yes, from banks', 1),
       (21, 'Yes, from citizens', 1),

       (22, 'No', 0),
       (22, 'Yes, the feed-in tariff has been identified', 1),
       (22, 'Yes, the technical scenario has been selected', 1),
       (22, 'Yes, the means of production has been decided', 1),
       (22, 'Yes, the site has been chosen', 1),
       (22, 'Yes, the file has been submitted to the authorities for approval', 1),

       (23, 'No, a public enquiry is going to take place', 0),
       (23, 'No, the file is being reviewed', 0),
       (23, 'No, the project is being appealed ', 0),
       (23, 'Yes, there has been administration approval', 3),

       (24, 'No, it has not been started yet', 0),
       (24, 'No, but it is in progress', 0),
       (24, 'No, a feasibility study is ongoing', 0),
       (24, 'Yes, the financial plan is consolidated', 1),
       (24, 'Yes, and a risk assessment has been carried out', 1),
       (24, 'Yes, the banking file is complete', 1),

       (25, 'No', 0),
       (25, 'Yes, bank loan', 1),
       (25, 'Yes, members’ investments', 1),
       (25, 'Yes, government funding scheme', 1),

       (26, 'No', 0),
       (26, 'Yes, the land leasing contracts have been signed', 1),
       (26, 'Yes, the energy feed-in tariffs have been agreed', 1),
       (26, 'Yes, materials and production machines have been agreed', 1),
       (26, 'Yes, maintenance contracts have been agreed', 1),
       (26, 'Yes, building providers have been agreed', 1),

       (27, 'No', 0),
       (27, 'Yes, there has been a session to discuss citizen involvement in project management', 1),
       (27, 'Yes, an official project management plan has been put in place', 1),
       (27, 'Yes, there has been a group visit to the construction site', 1),
       (27, 'Yes, plans are in place for preparation of operation monitoring', 1),

       (28, 'No', 0),
       (28, 'Yes, construction had commenced', 1),
       (28, 'Yes, providers for neighborhood impact monitoring studies have been identified', 1),
       (28, 'Yes, providers for environmental studies have been identified', 1),
       (28, 'Yes, providers for system monitoring have been identified', 1),
       (28, 'Yes, the site has been commissioned', 1),

       (29, 'No, construction is still ongoing', 0),
       (29, 'No, but construction is complete and it has been inaugurated', 0),
       (29, 'Yes, with ongoing communication regarding the operation', 3),

       (30, 'No', 0),
       (30, 'Yes, the finances are managed through the committee', 1),
       (30, 'Yes, profits have been allocated', 1),

       (31, 'No', 0),
       (31, 'Yes, neighborhood impact monitoring in the first year of the project', 1),
       (31, 'Yes, environmental monitoring every year of the project', 1),
       (31, 'Yes, preventative maintenance and repairs are being carried out regularly', 1),
       (31, 'Yes, the production site is being continuously technically monitored', 1),

       (32, 'No', 0),
       (32, 'Yes, they have hosted a general assembly with the executive board', 1),
       (32, 'Yes, and compensatory measures have been put in place for citizens', 1),
       (32, 'Yes, they keep in touch with residents of the project', 1),

       (33, 'No', 0),
       (33, 'Yes, about renewable energy', 1),
       (33, 'Yes, about the environment', 1),
       (33, 'Yes, about energy saving', 1);

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
    FOREIGN KEY (project_id) REFERENCES `#__pt_project` (id) ON DELETE CASCADE,
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
    FOREIGN KEY (project_id) REFERENCES `#__pt_project` (id) ON DELETE CASCADE,
    FOREIGN KEY (approval_id) REFERENCES `#__pt_approval_question` (id)
)
    ENGINE = InnoDB
    AUTO_INCREMENT = 0
    DEFAULT CHARSET = utf8mb4
    DEFAULT COLLATE = utf8mb4_unicode_ci;

/* */

CREATE TABLE `#__pt_progress_goal`
(
    `id`          TINYINT UNSIGNED NOT NULL AUTO_INCREMENT,
    `category_id` TINYINT UNSIGNED NOT NULL,
    `goal`        VARCHAR(255)     NOT NULL,
    CONSTRAINT id PRIMARY KEY (id),
    FOREIGN KEY (category_id) REFERENCES `#__pt_category` (id)
)
    ENGINE = InnoDB
    AUTO_INCREMENT = 0
    DEFAULT CHARSET = utf8mb4
    DEFAULT COLLATE = utf8mb4_unicode_ci;

INSERT INTO `#__pt_progress_goal` (`category_id`, `goal`)
VALUES (1, 'Awareness activities about existing Beacon projects, Educational actions of local associations, Private developer prospection'),
       (1, 'Local initiatives: new ideas + willpower of individuals, citizens, associations and local communities'),
       (1, 'Leading group'),
       (1,
        'Masterclasses: democratic organisation of the citizen group, Legal structuring, Technical issues, Initial financial elements, Expansion of the citizen group'),
       (1, 'Brainwork on: goals and values of the group, The type of energy and awareness actions around energy transition'),
       (1, 'Organisation of the group, Founding of the association'),
       (1, 'Support of local authorities, to obtain official support from local bodies'),
       (1, 'Founding of the project society'),
       (1, 'Public meetings and Advanced training: technical training, financing plan, negotiation training, building project management'),
       (1, 'Setting up of agreements with local authorities'),
       (1, 'Establish contacts with administrative authorities'),
       (1, 'Citizen financial mobilisation'),
       (1, 'Brainwork on the citizen involvement in project management'),
       (1, 'Project management'),
       (1, 'Work site visit'),
       (1, 'Preparation for the operation monitoring'),
       (1, 'Inauguration'),
       (1, 'Ongoing communication on operation'),
       (1, 'Management of the cooperative: general assembly, executive board, retain strong bonds with citizens, compensatory measure'),
       (1, 'Keep in touch with the residents of the project'),
       (1, 'Educational activities on: renewable energy, environmental effects, Energy savings'),

       (2, 'Think thank: type of governance, financial structuring, types of partnerships, how to distribute the benefits'),
       (2, 'Meeting with potential partner'),
       (2, 'Preliminary financing plan'),
       (2, 'Financial mobilisation, launch fundraising for development costs, reinforcement of funding partnerships'),
       (2, 'Preparation of the financial mobilisation for the construction phase'),
       (2, 'Consolidation of the financial plan'),
       (2, 'Assessment of the valuation of the risk'),
       (2, 'Completion of the banking file'),
       (2, 'Fundraising and bank loan for the construction phase'),
       (2, 'Financial management accounting'),
       (2, 'Profit allocation management'),

       (3, 'Preliminary evaluation of the territory'),
       (3, 'Project choice'),
       (3, 'Land leasing commitment'),
       (3, 'Ongoing analysis and validation: Technical committee, quotations, providers'),
       (3, 'Technical Studies on a risk-sensitive basis and on the level of funds needed'),
       (3, 'Technical file for submission for administrative approval'),
       (3, 'Submission of the file to approval of authorities'),
       (3, 'Public enquiry / review of the file'),
       (3, 'Administration approval'),
       (3, 'Land leasing contracts'),
       (3, 'Signing of the construction contracts'),
       (3, 'Construction Site'),
       (3, 'Commissioning'),
       (3, 'Environmental monitoring'),
       (3, 'Preventative maintenance and repairs');

/* */

CREATE TABLE `#__pt_measurement_category`
(
    `id`         TINYINT UNSIGNED NOT NULL AUTO_INCREMENT,
    `category`   VARCHAR(255)     NOT NULL,
    `colour_hex` VARCHAR(7)       NOT NULL DEFAULT ('#ffffff'),
    `colour_rgb` VARCHAR(13)      NOT NULL DEFAULT ('255, 255, 255'),
    CONSTRAINT id PRIMARY KEY (id)
)
    ENGINE = InnoDB
    AUTO_INCREMENT = 0
    DEFAULT CHARSET = utf8mb4
    DEFAULT COLLATE = utf8mb4_unicode_ci;

INSERT INTO `#__pt_measurement_category` (`category`, `colour_hex`, `colour_rgb`)
VALUES ('Emergence', '#81bce4', '129, 188, 228'),
       ('Development', '#9ae481', '154, 228, 129'),
       ('Funding', '#8181e4', '129, 129, 228'),
       ('Building', '#e48181', '228, 129, 129'),
       ('Exploitation', '#b381e4', '179, 129, 228');

/* */

CREATE TABLE `#__pt_measurement`
(
    `id`          TINYINT UNSIGNED NOT NULL AUTO_INCREMENT,
    `category_id` TINYINT UNSIGNED NOT NULL,
    `measurement` VARCHAR(255)       NOT NULL DEFAULT ('#ffffff'),
    CONSTRAINT id PRIMARY KEY (id),
    FOREIGN KEY (category_id) REFERENCES `#__pt_measurement_category` (id)
)
    ENGINE = InnoDB
    AUTO_INCREMENT = 0
    DEFAULT CHARSET = utf8mb4
    DEFAULT COLLATE = utf8mb4_unicode_ci;

INSERT INTO `#__pt_measurement` (`category_id`, `measurement`)
VALUES (1, 'Awareness actions '),
       (1, 'Local initiatives'),
       (1, 'Leading group'),
       (1, 'Goals and values of the group'),
       (1, 'Founding of association'),
       (1, 'Support of local authorities'),
       (1, 'Founding of project society'),

       (2, 'Public meetings, awareness and educational activities'),
       (2, 'Setting up agreements with local authorities'),
       (2, 'Established contacts with administrative authorities'),
       (2, 'Citizen financial mobilisation'),
       (2, 'Citizen involvement in project management'),
       (2, 'Project management'),
       (2, 'Ongoing communication on operation'),
       (2, 'Keep in touch with residents of the project'),

       (3, 'Think tank'),
       (3, 'Meeting with potential partners'),
       (3, 'Preliminary finance plan'),
       (3, 'Financial mobilisation (creation of the co-op)'),
       (3, 'Prepare finance for the construction phase'),
       (3, 'Consolidation of the financial plan'),
       (3, 'Assessment of the valuation of the risk'),
       (3, 'Completion or the banking file'),
       (3, 'Fund raising and bank loan for construction phase'),
       (3, 'Financial management accounting'),
       (3, 'Profit allocation management'),

       (4, 'Preliminary evaluation of the territory'),
       (4, 'Project choice'),
       (4, 'Land leasing commitment'),
       (4, 'Technical committee, source quotations and providers'),
       (4, 'Technical studies for risk assessment'),
       (4, 'Technical file for submission for approval of authorities'),
       (4, 'Submission for approval ot authorities'),
       (4, 'Administration approval'),
       (4, 'Land leasing contracts signed'),
       (4, 'Signing of construction contracts'),
       (4, 'Work site visit'),
       (4, 'Preparation of the operation monitoring'),
       (4, 'Commissioning'),

       (5, 'Identify providers for acoustic studies, environmental studies, monitoring systems'),
       (5, 'Inauguration'),
       (5, 'Management of the cooperative: general assembly, executive board, retain strong bonds with citizens, compensatory measure'),
       (5, 'Environmental monitoring'),
       (5, 'Preventative maintenance and repairs, Continuous technical monitoring of the production');

