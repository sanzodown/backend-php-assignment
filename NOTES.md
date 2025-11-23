# Notes

## Quick Start

```bash
./init.sh
```

This command will:
- Install dependencies
- Build Docker image
- Start MySQL container
- Create and migrate databases (dev + test)

## Commands

**Running tests:**

Use the provided `test.sh` script:
```bash
./test.sh              # Run all tests
./test.sh --testdox    # Run with testdox output
./test.sh --filter testGetKnights  # Run specific test
```

**Reset everything (clean start):**
```bash
./reset.sh
./init.sh
```

## Structure Changes

- Added Doctrine ORM with MySQL database
- Added dev fixtures
- Added integration tests for `KnightRepository`

- `Fighter::getPower()` return type changed from float to int because "strength" and "weaponPower" are both integers so it shouldn't be a float in any way. I also updated the interface.
- Bug in ArenaTest.php: The test expects `Arena::fight()` to return the fighter with the lower power level, but according to the instructions, it should return the winner AKA the fighter with higher power. So orc2 is now the real winner!
- Added a test case in ArenaTest.php to see if the logic work in both ways
- in `KnightRepositoryInterface` : Renamed `find()` to `findById()` to avoid conflict with Doctrine's `EntityRepository::find()` method

- Moved `Knight` from `Domain/` to `Entity/` following Symfony convention (Doctrine entities belong in Entity namespace)
- Moved `KnightRepositoryInterface` from `Domain/` to `Repository/` to keep contracts with their implementations
- Kept `Fighter` and `Arena` in `Domain/` because they represent pure business logic without framework dependencies
- Use `CONTENT_TYPE` instead of `HTTP_CONTENT_TYPE` in KnightControllerTest because this is one of the fiew headers who has not to be prefixed by HTTP_

- Fix various signatures and types
