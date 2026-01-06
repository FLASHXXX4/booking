# GitHub SSH Setup Guide

## Step 1: Check if you already have SSH keys

**Windows (Git Bash or PowerShell):**
```bash
ls -al ~/.ssh
```

Look for files named `id_rsa` and `id_rsa.pub` (or `id_ed25519` and `id_ed25519.pub`)

## Step 2: Generate a new SSH key (if you don't have one)

**Windows (Git Bash):**
```bash
ssh-keygen -t ed25519 -C "your_email@example.com"
```

**Or if ed25519 is not supported:**
```bash
ssh-keygen -t rsa -b 4096 -C "your_email@example.com"
```

**When prompted:**
- Press Enter to accept default file location (`C:\Users\YourName/.ssh/id_ed25519`)
- Enter a passphrase (optional but recommended) or press Enter twice to skip

## Step 3: Start the SSH agent

**Windows (Git Bash):**
```bash
eval "$(ssh-agent -s)"
```

**Windows (PowerShell):**
```powershell
Start-Service ssh-agent
```

## Step 4: Add your SSH key to the agent

**Windows (Git Bash):**
```bash
ssh-add ~/.ssh/id_ed25519
```

**Or if you used RSA:**
```bash
ssh-add ~/.ssh/id_rsa
```

## Step 5: Copy your public key

**Windows (Git Bash):**
```bash
cat ~/.ssh/id_ed25519.pub
```

**Windows (PowerShell):**
```powershell
Get-Content ~/.ssh/id_ed25519.pub
```

**Or manually:**
1. Navigate to `C:\Users\YourName\.ssh\`
2. Open `id_ed25519.pub` (or `id_rsa.pub`) in Notepad
3. Copy the entire content

## Step 6: Add SSH key to GitHub

1. Go to GitHub.com and sign in
2. Click your profile picture → **Settings**
3. In the left sidebar, click **SSH and GPG keys**
4. Click **New SSH key**
5. **Title**: Give it a name (e.g., "My Windows PC" or "Laptop")
6. **Key**: Paste your public key (the content you copied)
7. Click **Add SSH key**
8. Enter your GitHub password if prompted

## Step 7: Test your SSH connection

```bash
ssh -T git@github.com
```

**Expected output:**
```
Hi username! You've successfully authenticated, but GitHub does not provide shell access.
```

If you see this, you're all set!

## Step 8: Update your repository to use SSH

**If your repo is already cloned with HTTPS:**

```bash
cd C:\Users\Administrator\Desktop\BOOKING
git remote -v
```

**If it shows HTTPS (like `https://github.com/...`), change it to SSH:**

```bash
git remote set-url origin git@github.com:FLASHXXX4/booking.git
```

**Verify the change:**
```bash
git remote -v
```

Should now show: `git@github.com:FLASHXXX4/booking.git`

## Step 9: Test pushing with SSH

```bash
git add .
git commit -m "Test SSH connection"
git push origin master
```

If it works without asking for username/password, you're done!

---

## Troubleshooting

### "Permission denied (publickey)" error

1. **Check if key is added to agent:**
   ```bash
   ssh-add -l
   ```

2. **If empty, add it again:**
   ```bash
   ssh-add ~/.ssh/id_ed25519
   ```

3. **Verify key is on GitHub:**
   - Go to GitHub → Settings → SSH and GPG keys
   - Make sure your key is listed

### "Could not resolve hostname" error

- Check your internet connection
- Try: `ssh -T -p 443 git@ssh.github.com` (alternative port)

### Key not found error

- Make sure you're using the correct path: `~/.ssh/id_ed25519`
- Check if file exists: `ls ~/.ssh/`

### Still asking for password

- Make sure remote URL is SSH, not HTTPS
- Check: `git remote -v`
- Change if needed: `git remote set-url origin git@github.com:USERNAME/REPO.git`

---

## Quick Reference Commands

```bash
# Generate SSH key
ssh-keygen -t ed25519 -C "your_email@example.com"

# Start SSH agent
eval "$(ssh-agent -s)"

# Add key to agent
ssh-add ~/.ssh/id_ed25519

# Copy public key
cat ~/.ssh/id_ed25519.pub

# Test connection
ssh -T git@github.com

# Change remote to SSH
git remote set-url origin git@github.com:USERNAME/REPO.git

# Check remote URL
git remote -v
```

---

## Benefits of SSH

✅ No need to enter username/password every time  
✅ More secure than HTTPS  
✅ Works with all Git operations (push, pull, fetch)  
✅ One-time setup, works forever  

