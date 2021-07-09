# _Four Horsemen_: Restaurant App

[![Lint](https://github.com/TheRealSpectrum/four-horsemen-restaurant/actions/workflows/lint.yml/badge.svg)](https://github.com/TheRealSpectrum/four-horsemen-restaurant/actions/workflows/lint.yml)

## Quick setup

```bash
composer install

# sail is an alias to './vendor/bin/sail'. Use the quoted name instead if you don't know what that means.
sail up # add '-d' if you want to keep control of your terminal
sail artisan key:generate
sail artisan migrate:fresh --seed
```

## Linting

This project uses eslint and prettier to check for problems and enforce code style.
VsCode has the [prettier extension](https://marketplace.visualstudio.com/items?itemName=esbenp.prettier-vscode) which can automatically format the document on save.
It is highly recommended to use this plugin when using vscode.

Included in the repository is a pre-commit git hook.
This will automatically run both linters before commiting.
To use the hook run the following command:

```bash
git config core.hooksPath .githooks
```

> Note:
> This will use docker to run the commands.
> Make sure you ran `sail up` before commiting anything.

## Git

### features

Features are implemented using a few steps:

1. Pull the lates version of `main`.
2. Create a new branch with the format `patch-{name}-{feature}`.
3. Write your changes with multiple commits.
4. Try to merge the `main` branch.
5. Create and merge a Pull Request on github.

Example:

```bash
# Pull latest version of main
git pull

# Create new branch
git switch -C patch-damymetzke-add-recipe-model

# Make changes
git commit -m "Write recipe model"
git commit -m "Write relations for recipe model"
git commit -m "Write unit test for recipe model"
git commit -m "Document recipe model"

# Merge main
git pull origin main
git merge main -m "Merge main into feature"

# The following commands are executed using the github cli tool. These steps also be taken graphically on github.com

# Create pull request
gh pr create

# merge pull request (number should be displayed as ouput of previous command)
gh pr merge 42
```

There are a few important rules:

-   Feature branches are supposed to be short. It is better to merge too often as opposed to merging not often enough.
-   Each feature must only do 1 thing. Do not fix some unrelated piece of code in the same feature branch where you implement a new feature.
-   Always use clear and relevant titles in the pull requests. These will be visible in the git history.
-   We do not merge with a rebase or squash.
-   Do not rebase your branch in order to get it closer, always use merges.
-   Only sqush commits that should be together. We actively avoid losing information.

### Commits

-   The first line in each commit must not exceed 50 characters.
-   The first word of the commit is capatalized.
-   The first word of the commit is always a verb describing what has been done. Examples:
    -   Write
    -   Fix
    -   Change
    -   Document
    -   Refactor
-   The first word is always in presen tense
    -   Correct: Write
    -   Incorrect: Written
-   If more lines are added 1 white space must come after the first line.
-   The first line of the commit message does not use any punctuation (,.).
-   (Optional) use backticks '`' for symbols or file names.
-   (Optional) reference GitHub issues by prefixing them with '#'.

Example of valid commit message:

```git-commit
Add `Recipe` model

Quick implementation for #52, Must be completed later.
```
