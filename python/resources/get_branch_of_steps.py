import sys
if len(sys.argv) > 1 and sys.argv[1] == 'help':
    print("Usage: python get_branch_of_steps.py < int")
    exit()


uniquePaths = sys.stdin.readlines()
#print(a)
for branchStr in uniquePaths:
    if sys.argv[1]+"steps" in branchStr:
        print(branchStr.strip())
