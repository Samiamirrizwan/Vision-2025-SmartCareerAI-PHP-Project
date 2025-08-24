-- Sample data for the 'admins' table
-- The password for this admin is 'admin_password'
INSERT INTO `admins` (`id`, `name`, `email`, `password`) VALUES
(1, 'Admin User', 'admin@smartcareer.ai', '$2y$10$I/hJc.E9d.2n.EtJ2/a1keoZp2q.xgH8tJ3.Y2.a9Qk2.N.o.U.O');

-- Sample data for the 'users' table
-- Passwords are 'password123' for all sample users
INSERT INTO `users` (`id`, `name`, `email`, `password`, `profile_image`, `theme`, `categories`, `created_at`) VALUES
(2, 'Alice Johnson', 'alice@example.com', '$2y$10$V.G.e3g0e/G.lD.h.I.j.k.L.m.N.o.P.q.R.s.T.u.V.w', NULL, 'dark', '["Technology", "Healthcare"]', '2023-10-26 05:00:00'),
(3, 'Bob Williams', 'bob@example.com', '$2y$10$V.G.e3g0e/G.lD.h.I.j.k.L.m.N.o.P.q.R.s.T.u.V.w', NULL, 'light', '["Finance", "Education"]', '2023-10-25 08:30:00'),
(4, 'Charlie Brown', 'charlie@example.com', '$2y$10$V.G.e3g0e/G.lD.h.I.j.k.L.m.N.o.P.q.R.s.T.u.V.w', NULL, 'dark', '["Creative Arts", "Marketing"]', '2023-10-24 12:15:00');

-- Sample data for the 'careers' table
INSERT INTO `careers` (`id`, `title`, `description`, `category`, `roadmap_link`) VALUES
(1, 'Software Developer', 'Creates applications or systems that run on a computer or another device. They might focus on system software, application software, or web development.', 'Technology', 'https://roadmap.sh/backend'),
(2, 'Data Scientist', 'Analyzes and interprets complex data to help organizations make better decisions. Uses statistics, machine learning, and programming skills.', 'Technology', 'https://roadmap.sh/data-scientist'),
(3, 'Registered Nurse', 'Provides and coordinates patient care, educates patients and the public about various health conditions, and provides advice and emotional support to patients and their families.', 'Healthcare', NULL),
(4, 'Financial Analyst', 'Provides guidance to businesses and individuals making investment decisions. They assess the performance of stocks, bonds, and other types of investments.', 'Finance', NULL);

-- Sample data for the 'mentors' table
INSERT INTO `mentors` (`id`, `name`, `email`, `field`, `bio`) VALUES
(1, 'Dr. Evelyn Reed', 'e.reed@example.com', 'Data Science', 'PhD in Computer Science with 15 years of experience in machine learning and big data analytics.'),
(2, 'Markus Chen', 'm.chen@example.com', 'Software Engineering', 'Lead Backend Engineer at a major tech company, specializing in scalable systems and cloud architecture.');

-- Sample data for 'test_questions'
INSERT INTO `test_questions` (`id`, `question_text`, `category`, `option_a`, `option_b`, `option_c`, `option_d`, `correct_option`) VALUES
(1, 'Which of the following is a backend programming language?', 'Technology', 'HTML', 'CSS', 'PHP', 'React', 'c'),
(2, 'What does a financial analyst primarily do?', 'Finance', 'Design websites', 'Analyze investment opportunities', 'Perform surgery', 'Write novels', 'b');

-- Note: No sample data for test_sessions, test_answers, or results is provided
-- as this data is typically generated through user interaction with the application.
