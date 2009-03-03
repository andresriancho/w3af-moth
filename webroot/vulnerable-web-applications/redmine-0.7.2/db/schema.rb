# This file is auto-generated from the current state of the database. Instead of editing this file, 
# please use the migrations feature of ActiveRecord to incrementally modify your database, and
# then regenerate this schema definition.
#
# Note that this schema.rb definition is the authoritative source for your database schema. If you need
# to create the application database on another system, you should be using db:schema:load, not running
# all the migrations from scratch. The latter is a flawed and unsustainable approach (the more migrations
# you'll amass, the slower it'll run and the greater likelihood for issues).
#
# It's strongly recommended to check this file into your version control system.

ActiveRecord::Schema.define(:version => 92) do

  create_table "attachments", :force => true do |t|
    t.integer  "container_id",                 :default => 0,  :null => false
    t.string   "container_type", :limit => 30, :default => "", :null => false
    t.string   "filename",                     :default => "", :null => false
    t.string   "disk_filename",                :default => "", :null => false
    t.integer  "filesize",                     :default => 0,  :null => false
    t.string   "content_type",                 :default => ""
    t.string   "digest",         :limit => 40, :default => "", :null => false
    t.integer  "downloads",                    :default => 0,  :null => false
    t.integer  "author_id",                    :default => 0,  :null => false
    t.datetime "created_on"
    t.string   "description"
  end

  create_table "auth_sources", :force => true do |t|
    t.string  "type",              :limit => 30, :default => "",    :null => false
    t.string  "name",              :limit => 60, :default => "",    :null => false
    t.string  "host",              :limit => 60
    t.integer "port"
    t.string  "account"
    t.string  "account_password",  :limit => 60
    t.string  "base_dn"
    t.string  "attr_login",        :limit => 30
    t.string  "attr_firstname",    :limit => 30
    t.string  "attr_lastname",     :limit => 30
    t.string  "attr_mail",         :limit => 30
    t.boolean "onthefly_register",               :default => false, :null => false
    t.boolean "tls",                             :default => false, :null => false
  end

  create_table "boards", :force => true do |t|
    t.integer "project_id",                      :null => false
    t.string  "name",            :default => "", :null => false
    t.string  "description"
    t.integer "position",        :default => 1
    t.integer "topics_count",    :default => 0,  :null => false
    t.integer "messages_count",  :default => 0,  :null => false
    t.integer "last_message_id"
  end

  add_index "boards", ["project_id"], :name => "boards_project_id"

  create_table "changes", :force => true do |t|
    t.integer "changeset_id",                               :null => false
    t.string  "action",        :limit => 1, :default => "", :null => false
    t.string  "path",                       :default => "", :null => false
    t.string  "from_path"
    t.string  "from_revision"
    t.string  "revision"
    t.string  "branch"
  end

  add_index "changes", ["changeset_id"], :name => "changesets_changeset_id"

  create_table "changesets", :force => true do |t|
    t.integer  "repository_id", :null => false
    t.string   "revision",      :null => false
    t.string   "committer"
    t.datetime "committed_on",  :null => false
    t.text     "comments"
    t.date     "commit_date"
    t.string   "scmid"
  end

  add_index "changesets", ["repository_id", "revision"], :name => "changesets_repos_rev", :unique => true

  create_table "changesets_issues", :id => false, :force => true do |t|
    t.integer "changeset_id", :null => false
    t.integer "issue_id",     :null => false
  end

  add_index "changesets_issues", ["changeset_id", "issue_id"], :name => "changesets_issues_ids", :unique => true

  create_table "comments", :force => true do |t|
    t.string   "commented_type", :limit => 30, :default => "", :null => false
    t.integer  "commented_id",                 :default => 0,  :null => false
    t.integer  "author_id",                    :default => 0,  :null => false
    t.text     "comments"
    t.datetime "created_on",                                   :null => false
    t.datetime "updated_on",                                   :null => false
  end

  create_table "custom_fields", :force => true do |t|
    t.string  "type",            :limit => 30, :default => "",    :null => false
    t.string  "name",            :limit => 30, :default => "",    :null => false
    t.string  "field_format",    :limit => 30, :default => "",    :null => false
    t.text    "possible_values"
    t.string  "regexp",                        :default => ""
    t.integer "min_length",                    :default => 0,     :null => false
    t.integer "max_length",                    :default => 0,     :null => false
    t.boolean "is_required",                   :default => false, :null => false
    t.boolean "is_for_all",                    :default => false, :null => false
    t.boolean "is_filter",                     :default => false, :null => false
    t.integer "position",                      :default => 1
    t.boolean "searchable",                    :default => false
    t.text    "default_value"
  end

  create_table "custom_fields_projects", :id => false, :force => true do |t|
    t.integer "custom_field_id", :default => 0, :null => false
    t.integer "project_id",      :default => 0, :null => false
  end

  create_table "custom_fields_trackers", :id => false, :force => true do |t|
    t.integer "custom_field_id", :default => 0, :null => false
    t.integer "tracker_id",      :default => 0, :null => false
  end

  create_table "custom_values", :force => true do |t|
    t.string  "customized_type", :limit => 30, :default => "", :null => false
    t.integer "customized_id",                 :default => 0,  :null => false
    t.integer "custom_field_id",               :default => 0,  :null => false
    t.text    "value"
  end

  add_index "custom_values", ["customized_type", "customized_id"], :name => "custom_values_customized"

  create_table "documents", :force => true do |t|
    t.integer  "project_id",                :default => 0,  :null => false
    t.integer  "category_id",               :default => 0,  :null => false
    t.string   "title",       :limit => 60, :default => "", :null => false
    t.text     "description"
    t.datetime "created_on"
  end

  add_index "documents", ["project_id"], :name => "documents_project_id"

  create_table "enabled_modules", :force => true do |t|
    t.integer "project_id"
    t.string  "name",       :null => false
  end

  add_index "enabled_modules", ["project_id"], :name => "enabled_modules_project_id"

  create_table "enumerations", :force => true do |t|
    t.string  "opt",        :limit => 4,  :default => "",    :null => false
    t.string  "name",       :limit => 30, :default => "",    :null => false
    t.integer "position",                 :default => 1
    t.boolean "is_default",               :default => false, :null => false
  end

  create_table "issue_categories", :force => true do |t|
    t.integer "project_id",                   :default => 0,  :null => false
    t.string  "name",           :limit => 30, :default => "", :null => false
    t.integer "assigned_to_id"
  end

  add_index "issue_categories", ["project_id"], :name => "issue_categories_project_id"

  create_table "issue_relations", :force => true do |t|
    t.integer "issue_from_id",                 :null => false
    t.integer "issue_to_id",                   :null => false
    t.string  "relation_type", :default => "", :null => false
    t.integer "delay"
  end

  create_table "issue_statuses", :force => true do |t|
    t.string  "name",       :limit => 30, :default => "",    :null => false
    t.boolean "is_closed",                :default => false, :null => false
    t.boolean "is_default",               :default => false, :null => false
    t.integer "position",                 :default => 1
  end

  create_table "issues", :force => true do |t|
    t.integer  "tracker_id",       :default => 0,  :null => false
    t.integer  "project_id",       :default => 0,  :null => false
    t.string   "subject",          :default => "", :null => false
    t.text     "description"
    t.date     "due_date"
    t.integer  "category_id"
    t.integer  "status_id",        :default => 0,  :null => false
    t.integer  "assigned_to_id"
    t.integer  "priority_id",      :default => 0,  :null => false
    t.integer  "fixed_version_id"
    t.integer  "author_id",        :default => 0,  :null => false
    t.integer  "lock_version",     :default => 0,  :null => false
    t.datetime "created_on"
    t.datetime "updated_on"
    t.date     "start_date"
    t.integer  "done_ratio",       :default => 0,  :null => false
    t.float    "estimated_hours"
  end

  add_index "issues", ["project_id"], :name => "issues_project_id"

  create_table "journal_details", :force => true do |t|
    t.integer "journal_id",               :default => 0,  :null => false
    t.string  "property",   :limit => 30, :default => "", :null => false
    t.string  "prop_key",   :limit => 30, :default => "", :null => false
    t.string  "old_value"
    t.string  "value"
  end

  add_index "journal_details", ["journal_id"], :name => "journal_details_journal_id"

  create_table "journals", :force => true do |t|
    t.integer  "journalized_id",                 :default => 0,  :null => false
    t.string   "journalized_type", :limit => 30, :default => "", :null => false
    t.integer  "user_id",                        :default => 0,  :null => false
    t.text     "notes"
    t.datetime "created_on",                                     :null => false
  end

  add_index "journals", ["journalized_id", "journalized_type"], :name => "journals_journalized_id"

  create_table "members", :force => true do |t|
    t.integer  "user_id",           :default => 0,     :null => false
    t.integer  "project_id",        :default => 0,     :null => false
    t.integer  "role_id",           :default => 0,     :null => false
    t.datetime "created_on"
    t.boolean  "mail_notification", :default => false, :null => false
  end

  create_table "messages", :force => true do |t|
    t.integer  "board_id",                         :null => false
    t.integer  "parent_id"
    t.string   "subject",       :default => "",    :null => false
    t.text     "content"
    t.integer  "author_id"
    t.integer  "replies_count", :default => 0,     :null => false
    t.integer  "last_reply_id"
    t.datetime "created_on",                       :null => false
    t.datetime "updated_on",                       :null => false
    t.boolean  "locked",        :default => false
    t.integer  "sticky",        :default => 0
  end

  add_index "messages", ["board_id"], :name => "messages_board_id"
  add_index "messages", ["parent_id"], :name => "messages_parent_id"

  create_table "news", :force => true do |t|
    t.integer  "project_id"
    t.string   "title",          :limit => 60, :default => "", :null => false
    t.string   "summary",                      :default => ""
    t.text     "description"
    t.integer  "author_id",                    :default => 0,  :null => false
    t.datetime "created_on"
    t.integer  "comments_count",               :default => 0,  :null => false
  end

  add_index "news", ["project_id"], :name => "news_project_id"

  create_table "projects", :force => true do |t|
    t.string   "name",           :limit => 30, :default => "",   :null => false
    t.text     "description"
    t.string   "homepage",       :limit => 60, :default => ""
    t.boolean  "is_public",                    :default => true, :null => false
    t.integer  "parent_id"
    t.integer  "projects_count",               :default => 0
    t.datetime "created_on"
    t.datetime "updated_on"
    t.string   "identifier",     :limit => 20
    t.integer  "status",                       :default => 1,    :null => false
  end

  create_table "projects_trackers", :id => false, :force => true do |t|
    t.integer "project_id", :default => 0, :null => false
    t.integer "tracker_id", :default => 0, :null => false
  end

  add_index "projects_trackers", ["project_id"], :name => "projects_trackers_project_id"

  create_table "queries", :force => true do |t|
    t.integer "project_id"
    t.string  "name",         :default => "",    :null => false
    t.text    "filters"
    t.integer "user_id",      :default => 0,     :null => false
    t.boolean "is_public",    :default => false, :null => false
    t.text    "column_names"
  end

  create_table "repositories", :force => true do |t|
    t.integer "project_id",               :default => 0,  :null => false
    t.string  "url",                      :default => "", :null => false
    t.string  "login",      :limit => 60, :default => ""
    t.string  "password",   :limit => 60, :default => ""
    t.string  "root_url",                 :default => ""
    t.string  "type"
  end

  create_table "roles", :force => true do |t|
    t.string  "name",        :limit => 30, :default => "",   :null => false
    t.integer "position",                  :default => 1
    t.boolean "assignable",                :default => true
    t.integer "builtin",                   :default => 0,    :null => false
    t.text    "permissions"
  end

  create_table "settings", :force => true do |t|
    t.string   "name",       :limit => 30, :default => "", :null => false
    t.text     "value"
    t.datetime "updated_on"
  end

  create_table "time_entries", :force => true do |t|
    t.integer  "project_id",  :null => false
    t.integer  "user_id",     :null => false
    t.integer  "issue_id"
    t.float    "hours",       :null => false
    t.string   "comments"
    t.integer  "activity_id", :null => false
    t.date     "spent_on",    :null => false
    t.integer  "tyear",       :null => false
    t.integer  "tmonth",      :null => false
    t.integer  "tweek",       :null => false
    t.datetime "created_on",  :null => false
    t.datetime "updated_on",  :null => false
  end

  add_index "time_entries", ["project_id"], :name => "time_entries_project_id"
  add_index "time_entries", ["issue_id"], :name => "time_entries_issue_id"

  create_table "tokens", :force => true do |t|
    t.integer  "user_id",                  :default => 0,  :null => false
    t.string   "action",     :limit => 30, :default => "", :null => false
    t.string   "value",      :limit => 40, :default => "", :null => false
    t.datetime "created_on",                               :null => false
  end

  create_table "trackers", :force => true do |t|
    t.string  "name",          :limit => 30, :default => "",    :null => false
    t.boolean "is_in_chlog",                 :default => false, :null => false
    t.integer "position",                    :default => 1
    t.boolean "is_in_roadmap",               :default => true,  :null => false
  end

  create_table "user_preferences", :force => true do |t|
    t.integer "user_id",   :default => 0,     :null => false
    t.text    "others"
    t.boolean "hide_mail", :default => false
    t.string  "time_zone"
  end

  create_table "users", :force => true do |t|
    t.string   "login",             :limit => 30, :default => "",    :null => false
    t.string   "hashed_password",   :limit => 40, :default => "",    :null => false
    t.string   "firstname",         :limit => 30, :default => "",    :null => false
    t.string   "lastname",          :limit => 30, :default => "",    :null => false
    t.string   "mail",              :limit => 60, :default => "",    :null => false
    t.boolean  "mail_notification",               :default => true,  :null => false
    t.boolean  "admin",                           :default => false, :null => false
    t.integer  "status",                          :default => 1,     :null => false
    t.datetime "last_login_on"
    t.string   "language",          :limit => 5,  :default => ""
    t.integer  "auth_source_id"
    t.datetime "created_on"
    t.datetime "updated_on"
    t.string   "type"
  end

  create_table "versions", :force => true do |t|
    t.integer  "project_id",      :default => 0,  :null => false
    t.string   "name",            :default => ""
    t.string   "description",     :default => ""
    t.date     "effective_date"
    t.datetime "created_on"
    t.datetime "updated_on"
    t.string   "wiki_page_title"
  end

  add_index "versions", ["project_id"], :name => "versions_project_id"

  create_table "watchers", :force => true do |t|
    t.string  "watchable_type", :default => "", :null => false
    t.integer "watchable_id",   :default => 0,  :null => false
    t.integer "user_id"
  end

  create_table "wiki_content_versions", :force => true do |t|
    t.integer  "wiki_content_id",                              :null => false
    t.integer  "page_id",                                      :null => false
    t.integer  "author_id"
    t.binary   "data"
    t.string   "compression",     :limit => 6, :default => ""
    t.string   "comments",                     :default => ""
    t.datetime "updated_on",                                   :null => false
    t.integer  "version",                                      :null => false
  end

  add_index "wiki_content_versions", ["wiki_content_id"], :name => "wiki_content_versions_wcid"

  create_table "wiki_contents", :force => true do |t|
    t.integer  "page_id",                    :null => false
    t.integer  "author_id"
    t.text     "text"
    t.string   "comments",   :default => ""
    t.datetime "updated_on",                 :null => false
    t.integer  "version",                    :null => false
  end

  add_index "wiki_contents", ["page_id"], :name => "wiki_contents_page_id"

  create_table "wiki_pages", :force => true do |t|
    t.integer  "wiki_id",    :null => false
    t.string   "title",      :null => false
    t.datetime "created_on", :null => false
  end

  add_index "wiki_pages", ["wiki_id", "title"], :name => "wiki_pages_wiki_id_title"

  create_table "wiki_redirects", :force => true do |t|
    t.integer  "wiki_id",      :null => false
    t.string   "title"
    t.string   "redirects_to"
    t.datetime "created_on",   :null => false
  end

  add_index "wiki_redirects", ["wiki_id", "title"], :name => "wiki_redirects_wiki_id_title"

  create_table "wikis", :force => true do |t|
    t.integer "project_id",                :null => false
    t.string  "start_page",                :null => false
    t.integer "status",     :default => 1, :null => false
  end

  add_index "wikis", ["project_id"], :name => "wikis_project_id"

  create_table "workflows", :force => true do |t|
    t.integer "tracker_id",    :default => 0, :null => false
    t.integer "old_status_id", :default => 0, :null => false
    t.integer "new_status_id", :default => 0, :null => false
    t.integer "role_id",       :default => 0, :null => false
  end

  add_index "workflows", ["role_id", "tracker_id", "old_status_id"], :name => "wkfs_role_tracker_old_status"

end
