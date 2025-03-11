-- Insert dummy users
INSERT INTO user (user_username, user_password, user_salt, user_email, user_fullname, user_gender, user_age, user_ic, user_contactNumber, user_photo, user_qualification, user_certificate, user_race, user_religion, user_language, user_workingExperienceWithJumpa)
VALUES
('admin', 'hashed_password', 'salt', 'admin@example.com', 'Admin User', 'Male', 35, '123456789', '0123456789', 'admin.jpg', 'Bachelor Degree', 'cert1.pdf', 'Race1', 'Religion1', 'English', '5 years'),
('employee1', 'hashed_password1', 'salt1', 'employee1@example.com', 'Employee One', 'Female', 28, '987654321', '0123456788', '../assets/images/profile2.jpeg', 'Diploma', 'cert2.pdf', 'Race2', 'Religion2', 'English, Malay', '2 years'),
('employee2', 'hashed_password2', 'salt2', 'employee2@example.com', 'Employee Two', 'Male', 30, '654321987', '0112233445', '../assets/images/profile3.jpeg', 'Bachelor Degree', 'cert3.pdf', 'Race3', 'Religion3', 'English, Tamil', '3 years'),
('employee3', 'hashed_password3', 'salt3', 'employee3@example.com', 'Employee Three', 'Female', 26, '321654987', '0198877665', '../assets/images/profile4.jpeg', 'Master Degree', 'cert4.pdf', 'Race4', 'Religion4', 'English, Chinese', '4 years');

-- Insert dummy tasks
INSERT INTO task (task_photo, task_title, task_description, task_date, task_duration, task_location, task_toolsRequired, task_pax, task_price, task_dressCode, task_gender, task_nationality, task_ageRange, task_muslimFriendly, task_foodProvision, task_transportProvision, task_status, user_id)
VALUES
('../assets/images/cleaning_house.jpeg', 'Cleaning', 'General house cleaning and tidying up.', '2025-03-15', '4 hours', 'House', 'Broom, Mop', 1, 100, 'Casual', 'Any', 'Any', '18-40', 1, 0, 1, 0, 1),
('../assets/images/painting_Wall.jpeg', 'Painting Wall', 'Paint the living room walls.', '2025-03-16', '5 hours', 'Home', 'Paint, Brushes', 1, 150, 'Overalls', 'Any', 'Any', '20-45', 0, 1, 0, 0, 2),
('../assets/images/lawn_mowing.jpeg', 'Lawn Mowing', 'Mow the front and backyard lawn.', '2025-03-17', '3 hours', 'Garden', 'Lawn Mower', 2, 80, 'Casual', 'Any', 'Any', '18-50', 1, 0, 0, 0, 3),
('../assets/images/cleaning_car.jpeg', 'Cleaning Car', 'Wash and vacuum the car.', '2025-03-18', '2 hours', 'Garage', 'Bucket, Sponge', 1, 50, 'Casual', 'Any', 'Any', '20-45', 0, 1, 1, 0, 4);

-- Insert dummy bids
INSERT INTO bidding (task_id, user_id, bidding_amount)
VALUES 
(1, 2, 120.00),
(2, 2, 140.00),
(3, 3, 90.00),
(4, 4, 110.00),
(5, 3, 220.00),
(1, 3, 130.00),
(2, 4, 160.00),
(5, 4, 210.00);

-- Insert dummy jobs
INSERT INTO job (user_id, task_id, bidding_id)
VALUES 
(2, 1, 1),
(2, 2, 2),
(3, 3, 3),
(4, 4, 4),
(3, 5, 5),
(3, 1, 6),
(4, 2, 7),
(4, 5, 8);
