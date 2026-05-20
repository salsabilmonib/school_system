-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 20, 2026 at 04:24 PM
-- Server version: 10.6.18-MariaDB
-- PHP Version: 5.6.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `school`
--

-- --------------------------------------------------------

--
-- Table structure for table `academic_years`
--

CREATE TABLE `academic_years` (
  `ID` int(11) NOT NULL,
  `name` varchar(20) NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `academic_years_semesters`
--

CREATE TABLE `academic_years_semesters` (
  `ID` varchar(45) NOT NULL,
  `academic_yearID` int(11) NOT NULL,
  `semesterID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `attendance`
--

CREATE TABLE `attendance` (
  `studentID` int(11) NOT NULL,
  `sessionID` int(11) NOT NULL,
  `status` varchar(45) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `created_by` varchar(45) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `updated_by` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `available_subjects`
--

CREATE TABLE `available_subjects` (
  `ID` varchar(45) NOT NULL,
  `academicYear_semesterID` varchar(45) NOT NULL,
  `subjectID` int(11) NOT NULL,
  `gradeLevel_classID` varchar(45) NOT NULL,
  `teacherID` int(11) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `created_by` varchar(45) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `updated_by` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `classes`
--

CREATE TABLE `classes` (
  `ID` int(11) NOT NULL,
  `name` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `exams`
--

CREATE TABLE `exams` (
  `ID` varchar(45) NOT NULL,
  `exam_typeID` int(11) NOT NULL,
  `availableSubjectsID` varchar(45) NOT NULL,
  `total_mark` double DEFAULT NULL,
  `date_time` datetime DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `created_by` varchar(45) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `updated_by` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `exam_types`
--

CREATE TABLE `exam_types` (
  `ID` int(11) NOT NULL,
  `name` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `grades`
--

CREATE TABLE `grades` (
  `ID` varchar(45) NOT NULL,
  `studentID` int(11) NOT NULL,
  `exams_examID` varchar(45) NOT NULL,
  `Grade` double UNSIGNED ZEROFILL NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `created_by` varchar(45) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `updated_by` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `grade_levels`
--

CREATE TABLE `grade_levels` (
  `ID` int(11) NOT NULL,
  `name` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `grade_levels_classes`
--

CREATE TABLE `grade_levels_classes` (
  `ID` varchar(45) NOT NULL,
  `gradeLevelID` int(11) NOT NULL,
  `classID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `parents`
--

CREATE TABLE `parents` (
  `ID` int(11) NOT NULL,
  `first_name` varchar(45) NOT NULL,
  `lastName` varchar(45) NOT NULL,
  `nationalID` varchar(45) NOT NULL,
  `phone_number` varchar(45) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `userID` int(11) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `created_by` varchar(45) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `updated_by` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `semesters`
--

CREATE TABLE `semesters` (
  `ID` int(11) NOT NULL,
  `name` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `ID` int(11) NOT NULL,
  `date_time` datetime DEFAULT NULL,
  `available_subjectsID` varchar(45) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `created_by` varchar(45) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `updated_by` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `ID` int(11) NOT NULL,
  `first_name` varchar(45) NOT NULL,
  `lastName` varchar(45) NOT NULL,
  `doB` date NOT NULL,
  `nationalID` varchar(45) NOT NULL,
  `photo` mediumblob DEFAULT NULL,
  `gender` varchar(10) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `created_by` varchar(45) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `updated_by` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `students_parents`
--

CREATE TABLE `students_parents` (
  `ID` varchar(45) NOT NULL,
  `studentID` int(11) NOT NULL,
  `parentID` int(11) NOT NULL,
  `relationship` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `student_class_enrollment`
--

CREATE TABLE `student_class_enrollment` (
  `ID` int(11) NOT NULL,
  `studentID` int(11) NOT NULL,
  `academicYear_semesterID` varchar(45) NOT NULL,
  `gradeLevel_classID` varchar(45) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `created_by` varchar(45) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `updated_by` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `student_subject_enrollment`
--

CREATE TABLE `student_subject_enrollment` (
  `ID` int(11) NOT NULL,
  `studentID` int(11) NOT NULL,
  `available_subjectsID` varchar(45) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `created_by` varchar(45) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `updated_by` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `subjects`
--

CREATE TABLE `subjects` (
  `ID` int(11) NOT NULL,
  `name` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `teachers`
--

CREATE TABLE `teachers` (
  `ID` int(11) NOT NULL,
  `first_name` varchar(45) NOT NULL,
  `lastName` varchar(45) NOT NULL,
  `nationalID` varchar(45) NOT NULL,
  `phoneNum` varchar(45) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `userID` int(11) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `created_by` varchar(45) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `updated_by` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(45) NOT NULL,
  `password` varchar(45) NOT NULL,
  `role` varchar(45) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `created_by` varchar(45) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `updated_by` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `role`, `created_at`, `created_by`, `updated_at`, `updated_by`) VALUES
(2, 'admin2', 'pass2', 'admin', NULL, NULL, NULL, NULL),
(31, 'admin1', 'pass1', 'admin', '2026-05-19 08:39:25', 'admin2', NULL, NULL),
(43, 't', 'titi', 'teacher', '2026-05-20 10:07:05', 'admin1', NULL, NULL),
(44, 'ss', 'ss', 'teacher', '2026-05-20 13:59:35', 'admin1', NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `academic_years`
--
ALTER TABLE `academic_years`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `name_UNIQUE` (`name`),
  ADD UNIQUE KEY `start_date_UNIQUE` (`start_date`),
  ADD UNIQUE KEY `end_date_UNIQUE` (`end_date`);

--
-- Indexes for table `academic_years_semesters`
--
ALTER TABLE `academic_years_semesters`
  ADD PRIMARY KEY (`ID`,`semesterID`,`academic_yearID`),
  ADD KEY `fk_academicYears_has_semesters_semesters1_idx` (`semesterID`),
  ADD KEY `fk_academicYears_has_semesters_academicYears1_idx` (`academic_yearID`);

--
-- Indexes for table `attendance`
--
ALTER TABLE `attendance`
  ADD PRIMARY KEY (`studentID`,`sessionID`),
  ADD KEY `fk_students_has_sessions_sessions1_idx` (`sessionID`),
  ADD KEY `fk_students_has_sessions_students1_idx` (`studentID`);

--
-- Indexes for table `available_subjects`
--
ALTER TABLE `available_subjects`
  ADD PRIMARY KEY (`ID`,`academicYear_semesterID`,`subjectID`,`gradeLevel_classID`,`teacherID`),
  ADD KEY `fk_academicYears_semesters_has_subjects_subjects1_idx` (`subjectID`),
  ADD KEY `fk_academicYears_semesters_has_subjects_academicYears_semes_idx` (`academicYear_semesterID`),
  ADD KEY `fk_academicYear_Semester_Subjects_gradeLevels_classes1_idx` (`gradeLevel_classID`),
  ADD KEY `fk_AvailableSubjects_teachers1_idx` (`teacherID`);

--
-- Indexes for table `classes`
--
ALTER TABLE `classes`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `exams`
--
ALTER TABLE `exams`
  ADD PRIMARY KEY (`ID`,`availableSubjectsID`,`exam_typeID`),
  ADD KEY `fk_exam_Types_has_AvailableSubjects_AvailableSubjects1_idx` (`availableSubjectsID`),
  ADD KEY `fk_exam_Types_has_AvailableSubjects_exam_Types1_idx` (`exam_typeID`);

--
-- Indexes for table `exam_types`
--
ALTER TABLE `exam_types`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `grades`
--
ALTER TABLE `grades`
  ADD PRIMARY KEY (`ID`,`studentID`,`exams_examID`),
  ADD KEY `fk_students_has_exams_exams1_idx` (`exams_examID`),
  ADD KEY `fk_students_has_exams_students1_idx` (`studentID`);

--
-- Indexes for table `grade_levels`
--
ALTER TABLE `grade_levels`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `grade_levels_classes`
--
ALTER TABLE `grade_levels_classes`
  ADD PRIMARY KEY (`ID`,`classID`,`gradeLevelID`),
  ADD KEY `fk_gradeLevels_has_classes_classes1_idx` (`classID`),
  ADD KEY `fk_gradeLevels_has_classes_gradeLevels1_idx` (`gradeLevelID`);

--
-- Indexes for table `parents`
--
ALTER TABLE `parents`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `userID_UNIQUE` (`userID`),
  ADD KEY `fk_parents_users1_idx` (`userID`);

--
-- Indexes for table `semesters`
--
ALTER TABLE `semesters`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`ID`,`available_subjectsID`),
  ADD KEY `fk_sessions_AvailableSubjects1_idx` (`available_subjectsID`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `students_parents`
--
ALTER TABLE `students_parents`
  ADD PRIMARY KEY (`ID`,`studentID`,`parentID`),
  ADD KEY `fk_students_has_parents_parents1_idx` (`parentID`),
  ADD KEY `fk_students_has_parents_students_idx` (`studentID`);

--
-- Indexes for table `student_class_enrollment`
--
ALTER TABLE `student_class_enrollment`
  ADD PRIMARY KEY (`ID`,`studentID`,`academicYear_semesterID`,`gradeLevel_classID`),
  ADD KEY `fk_student_Class_Enrollment_students1_idx` (`studentID`),
  ADD KEY `fk_student_Class_Enrollment_academicYears_semesters1_idx` (`academicYear_semesterID`),
  ADD KEY `fk_student_Class_Enrollment_gradeLevels_classes1_idx` (`gradeLevel_classID`);

--
-- Indexes for table `student_subject_enrollment`
--
ALTER TABLE `student_subject_enrollment`
  ADD PRIMARY KEY (`ID`,`available_subjectsID`,`studentID`),
  ADD KEY `fk_student_subject_enrollment_students1_idx` (`studentID`),
  ADD KEY `fk_student_subject_enrollment_AvailableSubjects1_idx` (`available_subjectsID`);

--
-- Indexes for table `subjects`
--
ALTER TABLE `subjects`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `teachers`
--
ALTER TABLE `teachers`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `userID_UNIQUE` (`userID`),
  ADD KEY `fk_teachers_users1_idx` (`userID`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `userID_UNIQUE` (`id`),
  ADD UNIQUE KEY `username_UNIQUE` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `academic_years`
--
ALTER TABLE `academic_years`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `academic_years_semesters`
--
ALTER TABLE `academic_years_semesters`
  ADD CONSTRAINT `fk_academicYears_has_semesters_academicYears1` FOREIGN KEY (`academic_yearID`) REFERENCES `academic_years` (`ID`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_academicYears_has_semesters_semesters1` FOREIGN KEY (`semesterID`) REFERENCES `semesters` (`ID`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `attendance`
--
ALTER TABLE `attendance`
  ADD CONSTRAINT `fk_students_has_sessions_sessions1` FOREIGN KEY (`sessionID`) REFERENCES `sessions` (`ID`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_students_has_sessions_students1` FOREIGN KEY (`studentID`) REFERENCES `students` (`ID`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `available_subjects`
--
ALTER TABLE `available_subjects`
  ADD CONSTRAINT `fk_AvailableSubjects_teachers1` FOREIGN KEY (`teacherID`) REFERENCES `teachers` (`ID`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_academicYear_Semester_Subjects_gradeLevels_classes1` FOREIGN KEY (`gradeLevel_classID`) REFERENCES `grade_levels_classes` (`ID`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_academicYears_semesters_has_subjects_academicYears_semeste1` FOREIGN KEY (`academicYear_semesterID`) REFERENCES `academic_years_semesters` (`ID`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_academicYears_semesters_has_subjects_subjects1` FOREIGN KEY (`subjectID`) REFERENCES `subjects` (`ID`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `exams`
--
ALTER TABLE `exams`
  ADD CONSTRAINT `fk_exam_Types_has_AvailableSubjects_AvailableSubjects1` FOREIGN KEY (`availableSubjectsID`) REFERENCES `available_subjects` (`ID`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_exam_Types_has_AvailableSubjects_exam_Types1` FOREIGN KEY (`exam_typeID`) REFERENCES `exam_types` (`ID`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `grades`
--
ALTER TABLE `grades`
  ADD CONSTRAINT `fk_students_has_exams_exams1` FOREIGN KEY (`exams_examID`) REFERENCES `exams` (`ID`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_students_has_exams_students1` FOREIGN KEY (`studentID`) REFERENCES `students` (`ID`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `grade_levels_classes`
--
ALTER TABLE `grade_levels_classes`
  ADD CONSTRAINT `fk_gradeLevels_has_classes_classes1` FOREIGN KEY (`classID`) REFERENCES `classes` (`ID`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_gradeLevels_has_classes_gradeLevels1` FOREIGN KEY (`gradeLevelID`) REFERENCES `grade_levels` (`ID`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `parents`
--
ALTER TABLE `parents`
  ADD CONSTRAINT `fk_parents_users1` FOREIGN KEY (`userID`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `sessions`
--
ALTER TABLE `sessions`
  ADD CONSTRAINT `fk_sessions_AvailableSubjects1` FOREIGN KEY (`available_subjectsID`) REFERENCES `available_subjects` (`ID`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `students_parents`
--
ALTER TABLE `students_parents`
  ADD CONSTRAINT `fk_students_has_parents_parents1` FOREIGN KEY (`parentID`) REFERENCES `parents` (`ID`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_students_has_parents_students` FOREIGN KEY (`studentID`) REFERENCES `students` (`ID`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `student_class_enrollment`
--
ALTER TABLE `student_class_enrollment`
  ADD CONSTRAINT `fk_student_Class_Enrollment_academicYears_semesters1` FOREIGN KEY (`academicYear_semesterID`) REFERENCES `academic_years_semesters` (`ID`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_student_Class_Enrollment_gradeLevels_classes1` FOREIGN KEY (`gradeLevel_classID`) REFERENCES `grade_levels_classes` (`ID`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_student_Class_Enrollment_students1` FOREIGN KEY (`studentID`) REFERENCES `students` (`ID`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `student_subject_enrollment`
--
ALTER TABLE `student_subject_enrollment`
  ADD CONSTRAINT `fk_student_subject_enrollment_AvailableSubjects1` FOREIGN KEY (`available_subjectsID`) REFERENCES `available_subjects` (`ID`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_student_subject_enrollment_students1` FOREIGN KEY (`studentID`) REFERENCES `students` (`ID`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `teachers`
--
ALTER TABLE `teachers`
  ADD CONSTRAINT `fk_teachers_users1` FOREIGN KEY (`userID`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
