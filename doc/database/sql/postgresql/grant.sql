-- Grant rights on all OpenRat tables 
--
-- Make sure to replace the word "username" with the real database username
-- On MySql this grants are mostly unnecessary.

GRANT SELECT,INSERT,UPDATE,DELETE ON or_acl           TO username;
GRANT SELECT,INSERT,UPDATE,DELETE ON or_value         TO username;
GRANT SELECT,INSERT,UPDATE,DELETE ON or_usergroup     TO username;
GRANT SELECT,INSERT,UPDATE,DELETE ON or_templatemodel TO username;
GRANT SELECT,INSERT,UPDATE,DELETE ON or_name          TO username;
GRANT SELECT,INSERT,UPDATE,DELETE ON or_link          TO username;
GRANT SELECT,INSERT,UPDATE,DELETE ON or_folder        TO username;
GRANT SELECT,INSERT,UPDATE,DELETE ON or_file          TO username;
GRANT SELECT,INSERT,UPDATE,DELETE ON or_element       TO username;
GRANT SELECT,INSERT,UPDATE,DELETE ON or_projectmodel  TO username;
GRANT SELECT,INSERT,UPDATE,DELETE ON or_page          TO username;
GRANT SELECT,INSERT,UPDATE,DELETE ON or_language      TO username;
GRANT SELECT,INSERT,UPDATE,DELETE ON or_template      TO username;
GRANT SELECT,INSERT,UPDATE,DELETE ON or_object        TO username;
GRANT SELECT,INSERT,UPDATE,DELETE ON or_group         TO username;
GRANT SELECT,INSERT,UPDATE,DELETE ON or_user          TO username;
GRANT SELECT,INSERT,UPDATE,DELETE ON or_project       TO username;