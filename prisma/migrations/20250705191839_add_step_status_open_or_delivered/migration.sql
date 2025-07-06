/*
  Warnings:

  - The values [SUBMITTED,COMPLETED] on the enum `StepStatus` will be removed. If these variants are still used in the database, this will fail.

*/
-- AlterEnum
BEGIN;
CREATE TYPE "StepStatus_new" AS ENUM ('OPEN', 'DELIVERED');
ALTER TABLE "Step" ALTER COLUMN "status" DROP DEFAULT;
ALTER TABLE "Step" ALTER COLUMN "status" TYPE "StepStatus_new" USING ("status"::text::"StepStatus_new");
ALTER TYPE "StepStatus" RENAME TO "StepStatus_old";
ALTER TYPE "StepStatus_new" RENAME TO "StepStatus";
DROP TYPE "StepStatus_old";
ALTER TABLE "Step" ALTER COLUMN "status" SET DEFAULT 'OPEN';
COMMIT;
